<?php

namespace cs4430\routes;
use cs4430\App;

class Example {
    public function __construct() {
        App::addRoute("example", [$this, 'exampleOutput']);
    }

    public static function exampleOutput() {
        App::display("example.php", [
            'name' => 'caleb',
        ]);
    }
}
new Example();
