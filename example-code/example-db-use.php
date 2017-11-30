<?php

class Example {
    public function __construct() {
        require 'db.php';
    }

    public function generalSqlQuery() {
        $args = [
            'category' => 'drugs',
        ];
        $query = "UPDATE `table` SET `price` = (`price` + 1.00) WHERE `category` = :category;";
        $results = DbConn::getResults($query, $args);
        var_dump($results);
    }
}

$e = new Example();

$e->generalSqlQuery();
