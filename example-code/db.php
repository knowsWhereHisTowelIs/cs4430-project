<?php

/**
 * PDO Db Connection wrapper
 */
class DbConn {
    const HOST = "localhost";
    const DB   = "northwind";
    const PORT = 3306;
    const USER = "root";
    const PASS = "root";
    /**
     * @var Pdo $inst
     */
    public static $inst;
    /**
     * @var \PDO $conn
     */
    public static $conn;

    /**
     * Initialize the connection
     */
    public function __construct() {
        $this->setupConnection();
    }

    /**
     * Connect to the database
     */
    private function setupConnection() {
        $connInfo = sprintf("mysql:host=%s;port=%d;dbname=%s", self::HOST, self::PORT, self::DB);
        try {
            self::$conn = new PDO($connInfo, self::USER, self::PASS);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            print "PDO Connection Error: " . $e->getMessage() . "\n";
            var_dump([
                'HOST'  => self::HOST,
                'PORT'  => self::PORT,
                'DB'    => self::DB,
                'USER'  => self::USER,
                'PASS'  => self::PASS,
            ]);
            die();
        }
    }

    /**
     * Get sql escaped string of arg
     * @param mixed $arg
     * @return string
     */
    public function escapeArg($arg) {
        return self::$conn->quote($arg);
    }

    /**
     * Get results from the query with debugging information
     * @param string $query
     * @param array $args
     * @param bool $getRows
     * @return array sql response info
     */
    public static function getResults(string $query, array $args, string $queryType = "select") {
        $response = [];
        $formattedArgs = [];
        $exception = null;
        $errored = false;
        $rowCount = -1;
        try {
            // start trasaction
            self::$conn->beginTransaction();
            // get query without binding arguments 
            $statement = self::$conn->prepare($query);
            // bind args to escape sql
            foreach($args as $k => $v) {
                $formattedArgs[":$k"] = $v;
            }
            // run query
            if ($statement->execute($formattedArgs) ) {
                // get rows that were effected
                $rowCount = $statement->rowCount();
                $response = []; // return empty array on sucess but insert/update
                switch($queryType) {
                    case "insert":
                        $response = self::$conn->lastInsertId();
                        break;
                    case "select":
                        if( $rowCount > 0 ) {
                            $response = $statement->fetchAll(PDO::FETCH_ASSOC);
                        }
                        break;
                }
                // query was successful so commit
                self::$conn->commit();
            } else {
                $errored = true;
            }
            $errorCode  = self::$conn->errorCode();
            $errored    = intval($errorCode) !== 0;
        } catch(PDOException $e) {
            // exception occured
            $errorCode  = self::$conn->errorCode();
            $errored    = true;
            $exception = $e->getMessage();
        }
        // get error info if exists
        $errorInfo  = self::$conn->errorInfo();
        // rollback trasaction in case error
        if( $errored ) {
            self::$conn->rollBack();
        }
        // return results with debugging info
        return [
            'response'  => $response,
            'count'     => $rowCount,
            'errored'   => $errored,
            'errorInfo' => $errorInfo,
            'errorCode' => $errorCode,
            'query'     => $query,
            'exception' => $exception,
        ];
    }

    /**
     * Sql insert wrapper
     * @param string $table
     * @param array $args
     * @return array sql response info
     * @throws Exception - invalid arg count
     */
    public static function insert(string $table, array $args) {
        if( empty($args) ) {
            throw new Exception("Must have nonempty args");
        }
        $keys = array_keys($args);
        $placeholders = [];
        foreach($keys as $k) $placeholders[] = ":$k";

        $query = sprintf("INSERT INTO `%s` (%s) VALUES(%s)",
            $table,
            "`".implode("`, `", $keys)."`",
            implode(", ", $placeholders)
        );
        $result = self::getResults($query, $args, "insert");
        return $result;
    }

    /**
     * Sql update wrapper
     * @param string $table
     * @param array $args
     * @param string $where
     * @return array sql response info
     * @throws Exception - invalid arg count
     */
    public static function update(string $table, array $args, string $where) {
        if( empty($args) ) {
            throw new Exception("Must have nonempty args");
        }
        $keys = array_keys($args);
        $columns = [];
        foreach($keys as $k) {
            $columns[] = "`$k` = :$k";
        }
        $query = sprintf("UPDATE `%s` SET \n\t%s \nWHERE %s;",
            $table,
            implode(", \n\t", $columns),
            $where
        );
        $result = self::getResults($query, $args, "update");
        return $result;
    }

    /**
     * Sql insert or update wrapper
     * @param string $table
     * @param array $args
     * @param string $where
     * @return array - sql response info
     * @throws Exception - invalid arg count
     */
    public static function insertOrUpdate(string $table, array $args, string $where) {
        if( empty($args) ) {
            throw new Exception("Must have nonempty args");
        }
        $query = "SELECT * FROM `$table` WHERE $where LIMIT 1;"; // only need to see if exsists so limit 1
        $result = self::getResults($query, []);
        if( $result['errored'] ) { // orror occured
            $response = $result;
        } else if ( empty($result['response']) ) { // row doesn't exist so update
            $response = self::insert($table, $args);
        } else { // row exists so update
            $response = self::update($table, $args, $where);
        }
        return $response;
    }

    /**
     * Sql delete info
     * @param string $table
     * @param array $args
     * @param string $where
     * @return array - sql response info
     * @throws Exception - invalid arg count
     */
    public static function delete(string $table, array $args, string $where) {
        if( empty($args) ) {
            throw new Exception("Must have nonempty args");
        }
        $query = "DELETE FROM `$table` WHERE $where;";
        $result = self::getResults($query, $args, "delete");
        return $result;
    }
}

new DbConn();
