<?php

namespace cs4430;

require 'assets/flask-php/vendor/autoload.php';

class MyFlaskPHP extends \FlaskPHP\FlaskPHP {
    public function __construct() {
        parent::__construct();
    }

    public function getRoutes() {
        return $this->routes;
    }
}
