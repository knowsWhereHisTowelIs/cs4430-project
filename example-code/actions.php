<?php

/**
 * Class that handles all actions related to the app
 */
class Actions {
    /**
     * Array of actions to prompt user to input
     * @var array
     */
    private $actions;

    /**
     * Setup includes and inititilize parameters
     */
    public function __construct() {
        $this->actions = [];
        require_once 'db.php';
        require_once 'validator.php';
    }

    /**
     * Update actions array with prompts and callbacks
     */
    public function registerActions() {
        $this->addAction("Add a customer",  [$this, 'addCustomer']);
        $this->addAction("Add an order",    [$this, 'addOrder']);
        $this->addAction("Remove an order", [$this, 'removeOrder']);
        $this->addAction("Ship an order",   [$this, 'shipOrder']);
        $this->addAction("Print pending orders with customer information",
            [$this, 'printPendingOrders']
        );
        $this->addAction("Restock Parts",   [$this, 'restockParts']);
        $this->addAction("Exit", ['MyApp', 'exit']);
    }

    /**
     * Add action to array with msg and callback
     * @param string $text - the prompt
     * @param mixed $callback - the handler
     */
    public function addAction(string $text, $callback) {
        $this->actions[] = [
            'text' => $text,
            'callback' => $callback
        ];
    }
    
    /**
     * Get the array of texts for all possible actions
     * @return array
     */
    public function getTexts() {
        $texts = [];
        foreach($this->actions as $r) {
            $texts[] = $r['text'];
        }
        return $texts;
    }

    /**
     * Perform the action based upon the index in array
     * @param int $action
     */
    public function performAction(int $action) {
        if( ! isset($this->actions[$action]) ) {
            printf("\n\tInvalid action\n");
        } else {
            call_user_func($this->actions[$action]['callback']);
        }
    }

    /**
     * Populate the args away with user input after msg prompt
     * @param string $msg - the block message prompt
     * @param array $args - passed by reference - the args to store
     **/
    private function populateArgs(string $msg, array &$args) {
        echo "$msg\n";
        // populate array
        foreach($args as $k => $validateCallback) {
            $validInput = false;
            // loop until valid input is recieved
            while( ! $validInput ) {
                printf("\t%15s: ", $k);
                $value = readline();
                // check if callback and if have to validate user input do it
                if( is_callable($validateCallback) ) {
                    // pass value by reference
                    list($validInput, $value) = call_user_func($validateCallback, $value);
                } else {
                    $validInput = true;
                }
                if( $validInput ) {
                    $args[$k] = $value;
                } else {
                    printf("\n\t\t --Invalid '%s' try again-- \n\n", $k);
                }
            }
        }
    }

    /**
     * Get user input and add customer to DB
     */
    public function addCustomer() {
        $new = [
            "table" => "customers",
            "msg" => "Input customer info:",
            "args" => [
                // input prompt => validation callback
                "CustomerID"    => ['Validator', 'newCustomerID'],
                "CompanyName"   => ['Validator', 'notEmpty'],
                "ContactName"   => ['Validator', 'notEmpty'],
                "ContactTitle"  => ['Validator', 'notEmpty'],
                "Address"       => ['Validator', 'notEmpty'],
                "City"          => ['Validator', 'notEmpty'],
                "Region"        => ['Validator', 'notEmpty'],
                "PostalCode"    => ['Validator', 'notEmpty'],
                "Country"       => ['Validator', 'notEmpty'],
                "Phone"         => ['Validator', 'notEmpty'],
                "Fax"           => ['Validator', 'notEmpty'],
            ],
        ];
        $this->populateArgs($new['msg'], $new['args']);
        $results = DbConn::insert($new['table'], $new['args']);
        if( $results['errored'] ) {
            printf("\n\tUnable to add customer. Please try again.\n\n");
            $this->addCustomer(); // try again
        }
    }

    /**
     * Prompt user input and add order to DB
     */
    public function addOrder() {
        $new = [
            "table"     => "orders",
            "msg"       => "Input order info:",
            "args"      => [
                // input prompt => validation callback
                // DONT Need auto incrementing "OrderID"       => null
                "CustomerID"    => ['Validator', 'customerIDExists'],
                "EmployeeID"    => ['validator', 'employeeIDExists'],
                "OrderDate"     => ['Validator', 'sqlDate'],
                "RequiredDate"  => ['Validator', 'nullOrSqlDate'],
                "ShippedDate"   => ['Validator', 'nullOrSqlDate'],
                "ShipVia"       => ['Validator', 'shipperIDExists'],
                "Freight"       => ['Validator', 'isNumeric'],
                "ShipName"      => ['Validator', 'notEmpty'],
                "ShipAddress"   => ['Validator', 'notEmpty'],
                "ShipCity"      => ['Validator', 'notEmpty'],
                "ShipRegion"    => ['Validator', 'notEmpty'],
                "ShipPostalCode"=> ['Validator', 'notEmpty'],
                "ShipCountry"   => ['Validator', 'notEmpty'],
            ],
        ];
        $this->populateArgs($new['msg'], $new['args']);
        $results = DbConn::insert($new['table'], $new['args']);
        // insert order
        if( $results['errored'] || empty($results['response']) ) {
            printf("\n\tUnable to add order. Please try again.\n\n");
        } else {
            $orderID = $results['response'];
            printf("\n\t\tAdded OrderID:%d\n", $orderID);
            // get add details
            $addDetails = true;
            while($addDetails) {
                $details = [
                    "table"     => "order_details",
                    "msg"       => "Input Order details",
                    "args"      => [
                        'ProductID' => ['Validator', 'productIDExists'],
                        'Quantity'  => ['Validator', 'intOneOrMore'],
                        'Discount'  => ['Validator', 'discountAmount'],
                    ],
                    'results'   => null,
                ];
                echo "\n";
                $this->populateArgs($details['msg'], $details['args']);
                $details['args']['OrderID'] = $orderID;
                $details['args']['UnitPrice'] = $this->getUnitPrice($details['args']['ProductID']);
                $details['results'] = DbConn::insert($details['table'], $details['args']);
                if( $details['results']['errored'] ) {
                    printf("\n\tUnable to add order details. Please try again.\n\n");
                    break;
                }
                // exit when done adding products
                printf("\tAdd product ('n' to exit): ");
                $cmd = readline();
                if( $cmd === 'n' ) {
                    $addDetails = false;
                }
            }
        }
    }
    
    /**
     * Get the unit price 
     * @param mixed $productID
     * @return bool|double
     */
    private function getUnitPrice($productID) {
        $query = "SELECT `UnitPrice` FROM `products` WHERE `ProductID` = :ProductID;";
        $results = DbConn::getResults($query, ['ProductID' => $productID]);
        
        if( $results['errored'] || empty($results['response']) ) {
            $price = false;
        } else {
            $price = doubleval($results['response'][0]);
        }
        
        return $price;
    }

    /**
     * Get user prompt and delete order from order
     */
    public function removeOrder() {
        $remove = [
            "table" => "orders",
            "msg"   => "Input order info to remove:",
            "args"  => [
                // input prompt => validation callback
                "OrderID"    => ['Validator', 'orderIDExists'],
            ],
            "where" => "`OrderID` = :OrderID",
        ];
        $this->populateArgs($remove['msg'], $remove['args']);
        
        $orderDetailsResults = DbConn::delete("order_details", $remove['args'], $remove['where']);
        $orderResults = DbConn::delete($remove['table'], $remove['args'], $remove['where']);
        
        if( $orderResults['errored'] || $orderDetailsResults['errored'] ) {
            var_dump($remove['args'], $orderResults, $orderDetailsResults);
            printf("\n\tInvalid Order please try again.\n");
        } else {
            printf("\n\tSuccessfully removed order\n");
        }
    }

    /**
     * Ship orders that haven't been shipped yet
     */
    public function shipOrder() {
        $update = [
            "table" => "orders",
            "msg" => "Input order info to ship:",
            "args" => [
                // input prompt => validation callback
                "OrderID"    => ['Validator', 'orderIDExists'],
            ],
        ];
        $this->populateArgs($update['msg'], $update['args']);
        $updateQuery = sprintf("UPDATE `%s` SET `ShippedDate` = NOW() WHERE "
                . "`OrderID` = :OrderID AND `ShippedDate` IS NULL;", $update['table']);
        $results = DbConn::getResults($updateQuery, $update['args'], "update");
        if( $results['errored'] ) {
            printf("\n\tUnable to ship order. Please try again.\n");
        } else {
            printf("\n\tSuccessfully shipped order\n");
        }
    }

    /**
     * Search through Orders table and display orders that haven't been shipped
    **/
    public function printPendingOrders() {
        $query = "SELECT * FROM `orders` WHERE `ShippedDate` is NULL ORDER BY `OrderDate`;";
        $result = DbConn::getResults($query, []);
        if( empty( $result['response'] ) ) {
            printf("\n\tThere are no current pending orders\n");
        } else {
            printf("\n\tThere are %d pending orders:\n", count($result['response']));
            foreach($result['response'] as $i => $row) {
                unset($row['ShippedDate']);// dont show shipped date since its null
                printf("\tPending order #%d\n", $i);
                foreach($row as $k => $v ) {
                    printf("\t\t%15s: %s\n", $k, $v);
                }
                $customer = $this->getCustomerInfo($row['CustomerID']);
                if( $customer === false ) {
                    printf("\t\t\tInvalid Customer Info\n");
                } else {
                    printf("\t\t\t -- Customer Info --\n");
                    foreach($customer as $k => $v ) {
                        printf("\t\t\t%15s: %s\n", $k, $v);
                    }
                }
                printf("\n");
            }
        }
    }
    
    /**
     * Get customer info by id
     * @param mixed $customerID
     * @return bool|array
     */
    private function getCustomerInfo($customerID) {
        $query = "SELECT * FROM `customers` WHERE `CustomerID` = :CustomerID LIMIT 1";
        $args = [
            'CustomerID' => $customerID,
        ];
        $result = DbConn::getResults($query, $args);
        
        if( $result['errored'] || empty($result['response']) ) {
            $info = false;
        } else {
            $info = $result['response'][0];
        }
        return $info;
    }

    /**
     * Restock all parts which have units on order
     */
    public function restockParts() {
        $query = "UPDATE `products` SET `UnitsInStock` = (`UnitsInStock` + `UnitsOnOrder`), "
                . " `UnitsOnOrder` = 0 WHERE `UnitsOnOrder` > 0";
        $result = DbConn::getResults($query, [], false);
        if( $result['errored'] ) {
            printf("\n\tA problem occured restocking parts please try again \n");
            // DON'T RECALL function b/c no user input
        } else {
            printf("\n\tSuccessfully restocked parts\n");
        }
    }

    /**
     * Action to trigger program ending
     */
    public function end() {
        MyApp::end();
    }

}