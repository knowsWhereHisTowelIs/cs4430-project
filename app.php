<?php
namespace cs4430;

use FlaskPHP\FlaskPHP;
use FlaskPHP\Template\PhpTemplate;
use FlaskPHP\Template\TwigTemplate;
/**
 * Typehinting requires PHP >= 7.0
 * Uses:
    * smarty
    * https://github.com/Web-Engine/flask-php
**/
class App {
    public static $smarty;
    public static $flask;
    /**
     * Application dispatcher
    **/
    public function __construct() {
        // TODO remove debugging info
        error_reporting(E_ERROR|E_WARNING|E_PARSE);
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        // END TODO
        $this->setupDependencies();
        self::$flask->run();
    }

    public function setupDependencies() {
        require 'debug.php';
        require 'files.php';
        Files::includeFilesRecursively("includes");
        $this->setupRoutesHandler();
    }

    private function setupRoutesHandler() {
        self::$flask = new MyFlaskPHP();
        Files::includeFilesRecursively("routes");
    }

    /**
     * https://github.com/Web-Engine/flask-php/blob/master/test/index.php
    **/
    public static function addRoute(string $route, callable $callback) {
        self::$flask->route($route, function() use ($callback){
            ob_start();
            $callback();
            return ob_get_clean();
        });
    }

    /**
     * @ref https://twig.symfony.com/doc/2.x/templates.html
    **/
    public static function display(string $template, array $args = []) {
        $template = "public/templates/$template";
        // must use callback so that the template uses the dir of this file
        $callback = function($template, $args) {
            echo PhpTemplate::render($template, $args)->getContent();
        };
        return $callback($template, $args);
        // formatted_var_dump($template, $args);
        // return PhpTemplate::render($template, $args);
    }

    public static function getDir() {
        return __DIR__ . '/';
    }

    public static function getAllRoutes() {
        return self::$flask->getRoutes();
    }

    public static function redirect($relUrl) {
        $link = sprintf("%s://%s/%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            $relUrl
        );
        header("Location: $link");
        die;
    }
}

register_shutdown_function(function(){
    $e = error_get_last();
    if( ! is_null($e) ) {
        echo "<PRE>";
        var_dump(debug_backtrace());
        var_dump($e['message']);
    }
});

try { // TODO Remove try catch - just debugging to format
    new App();
} catch(Exception $e) {
    formatted_var_dump($e->getMessage());
}
