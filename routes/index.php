<?php

namespace cs4430\routes;
use cs4430\App;

class Index {
    public function __construct() {
        App::addRoute("/", [$this, 'display']);
    }

    public static function display() {
        $routes = [];
        $rawRoutes = array_keys( App::getAllRoutes() );
        foreach($rawRoutes as $route) { // truncate before '<'
            $pos = strpos($route, "<");
            $routes[] = ( $pos === false ) ? $route : substr($route, 0, $pos);
        }
        App::display("index.php", [
            'routes' => $routes
        ]);
    }
}
new Index();
