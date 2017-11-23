<?php

namespace cs4430;

class Example {
    public function __construct() {
        App::addRoute("/example", [$this, 'exampleOutput']);
    }

    public static function exampleOutput() {
        App::display("example.twig", [
            'name' => 'caleb',
        ]);
    }
}
new Example();
