#!/usr/bin/php
<?php

class MyApp {
    public function __construct() {
        $this->includeFiles();
    }

    public function includeFiles() {
        require 'vendor/autoload.php';
        require_once 'db.php';
    }


}

new MyApp();
