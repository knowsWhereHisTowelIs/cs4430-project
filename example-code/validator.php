<?php

/**
 * Validate user input
 */
class Validator {
    /**
     * Make sure all dependencies are met
     */
    public function __construct() {
        require_once 'db.php';
    }
    
    /**
     * Check if is a new customer ID
     * @param string $str
     * @return array [valid, value]
     */
    public static function newCustomerID(string $str) {
        $valid = false;
        $value = false;
        if( is_numeric($str) && intval($str) == $str ) {
            // valid int input
            $select = [
                'query' => 'SELECT `CustomerID` FROM `customers` WHERE `CustomerID` = :CustomerID LIMIT 1;',
                'args' => [
                    'CustomerID' => $str,
                ],
            ];
            $results = DbConn::getResults($select['query'], $select['args']);
            if( ! $results['errored'] && $results['count'] === 0 ) {
                $valid = true;
                $value = intval($str);
            }
        }
        return [$valid, $value];
    }
    
    /**
     * Check if customer id exists
     * @param string $str
     * @return array [valid, value]
     */
    public static function customerIDExists(string $str) {
        $valid = false;
        $value = false;
        
        if( is_numeric($str) && intval($str) == $str ) {
            // valid int input
            $select = [
                'query' => 'SELECT `CustomerID` FROM `customers` WHERE `CustomerID` = :CustomerID LIMIT 1;',
                'args' => [
                    'CustomerID' => $str,
                ],
            ];
            $results = DbConn::getResults($select['query'], $select['args']);
            if( ! $results['errored'] && $results['count'] === 1 ) {
                $valid = true;
                $value = intval($str);
            }
        }
        
        return [$valid, $value];
    }
    
    /**
     * Check if employee id exists
     * @param string $str
     * @return array [valid, value]
     */
    public static function employeeIDExists(string $str) {
        $valid = false;
        $value = false;
        
        if( is_numeric($str) && intval($str) == $str ) {
            // valid int input
            $select = [
                'query' => 'SELECT `EmployeeID` FROM `employees` WHERE `EmployeeID` = :EmployeeID LIMIT 1;',
                'args' => [
                    'EmployeeID' => $str,
                ],
            ];
            $results = DbConn::getResults($select['query'], $select['args']);
            if( ! $results['errored'] && $results['count'] === 1 ) {
                $valid = true;
                $value = intval($str);
            }
        }
        
        return [$valid, $value];
    }
    
    /**
     * Check if order id exists
     * @param string $str
     * @return array [valid, value]
     */
    public static function orderIDExists(string $str) {
        $valid = false;
        $value = false;
        
        if( is_numeric($str) && intval($str) == $str ) {
            // valid int input
            $select = [
                'query' => 'SELECT `OrderID` FROM `orders` WHERE `OrderID` = :OrderID LIMIT 1;',
                'args' => [
                    'OrderID' => $str,
                ],
            ];
            $results = DbConn::getResults($select['query'], $select['args']);
            if( ! $results['errored'] && $results['count'] === 1 ) {
                $valid = true;
                $value = intval($str);
            }
        }
        
        return [$valid, $value];
    }
    
    /**
     * CHeck if shipper id exists
     * @param string $str
     * @return array [valid, value]
     */
    public static function shipperIDExists(string $str) {
        $valid = false;
        $value = false;
        
        if( is_numeric($str) && intval($str) == $str ) {
            // valid int input
            $select = [
                'query' => 'SELECT `ShipperID` FROM `shippers` WHERE `ShipperID` = :ShipperID LIMIT 1;',
                'args' => [
                    'ShipperID' => $str,
                ],
            ];
            $results = DbConn::getResults($select['query'], $select['args']);
            if( ! $results['errored'] && $results['count'] === 1 ) {
                $valid = true;
                $value = intval($str);
            }
        }
        
        return [$valid, $value];
    }
    
    /**
     * CHeck if product id exists
     * @param string $str
     * @return array [valid, value]
     */
    public static function productIDExists(string $str) {
        $valid = false;
        $value = false;
        
        if( is_numeric($str) && intval($str) == $str ) {
            // valid int input
            $select = [
                'query' => 'SELECT `ProductID` FROM `products` WHERE `ProductID` = :ProductID LIMIT 1;',
                'args' => [
                    'ProductID' => $str,
                ],
            ];
            $results = DbConn::getResults($select['query'], $select['args']);
            if( ! $results['errored'] && $results['count'] === 1 ) {
                $valid = true;
                $value = intval($str);
            }
        }
        
        return [$valid, $value];
    }
    
    /**
     * Check if string is empty
     * @param string $str
     * @return array [valid, value]
     */
    public static function notEmpty(string $str) {
        $valid = false;
        $value = false;
        if( ! empty($str) ) {
            $valid = true;
            $value = $str;
        }
        return [$valid, $value];
    }
    
    /**
     * Check if can parse string into datetime
     * @param string $str
     * @return array [valid, value]
     */
    public static function sqlDate(string $str) {
        $valid = false;
        $value = false;
        $time = strtotime($str);
        if( $time ) {
            $valid = true;
            $value = date("Y-m-d", $time);
        }
        return [$valid, $value];
    }
    
    /**
     * Check if string is null or valid datetime
     * @param string $str
     * @return array [valid, value]
     */
    public static function nullOrSqlDate(string $str) {
        if( empty($str) ) {
            $valid = true;
            $value = null;
        } else {
            list($valid, $value) = self::sqlDate($str);
        }
        return [$valid, $value];
    }
    
    /**
     * Make sure the string is numeric
     * @param string $str
     * @return array [valid, value]
     */
    public static function isNumeric(string $str) {
        $valid = false;
        $value = false;
        
        if(is_numeric($str) ) {
            $valid = true;
            $value = $str;
        }
        
        return [$valid, $value];
    }
    
    /**
     * Check that is int and > 0
     * @param string $str
     * @return array [valid, value
     */
    public static function intOneOrMore(string $str) {
        $valid = false;
        $value = false;
        
        $raw = intval($str);
        if(is_numeric($str) && $raw == $str && $raw > 0 ) {
            $valid = true;
            $value = $raw;
        }
        
        return [$valid, $value];
    }
    
    /**
     * Check that value is between 0.00 and 1.00
     * @param string $str
     * @return array [valid, value]
     */
    public static function discountAmount(string $str) {
        $valid = false;
        $value = false;
        
        $raw = doubleval($str);
        if(is_numeric($str) && $raw >= 0.00 && $raw <= 1.00 ) {
            $valid = true;
            $value = $raw;
        }
        
        return [$valid, $value];
    }
}

new Validator();