<?php

namespace cs4430;

class ExportDb {
    public function __construct() {
        App::addRoute("/", [$this, 'display']);
    }

    public static function display() {
        echo "DISPLAY";
    }
}
new ExportDb();
//
// App::addRoute("/", function(){});
//
// App::addRoute('/php', function () {
//     App::setTemplate("");
// });
//
// App::addRoute('/redirect', function () {
//     return redirect(url_for('/php'));
// });
//
// App::addRoute('/get/<int:int>', function ($int) {
//     var_dump($int);
// });
