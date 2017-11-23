<?php
namespace cs4430;

die("HERE");

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
        $this->setupDependencies();
        self::$flask->run();
    }

    public function setupDependencies() {
        require 'debug.php';
        require 'files.php';
        Files::includeFilesRecursively("includes");
        $this->setupTemplateEngine();
        $this->setupRoutesHandler();
    }

    private function setupTemplateEngine() {
        require 'assets/smarty/Smarty.class.php';
        self::$smarty = new \Smarty();
        // set template dirs
        self::$smarty->setTemplateDir('./public/templates');
        self::$smarty->setCompileDir('./public/templates_c');
        // self::$smarty->setCacheDir('./public/cache');
        // self::$smarty->setConfigDir('/smarty/configs');
    }

    private function setupRoutesHandler() {
        // require 'assets/flask-php/src/FlaskPHP.php';
        require 'assets/flask-php/vendor/autoload.php';
        self::$flask = new \FlaskPHP\FlaskPHP();
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
        // foreach($args as $k => $v) {
        //     self::$smarty->assign($k, $v);
        // }
        // self::$smarty->display($template);
        $template = "public/templates/$template";
        echo $template;
        return TwigTemplate::render($template, $args);
    }
}

try { // TODO Remove try catch - just debugging to format
    new App();
} catch(Exception $e) {
    formatted_var_dump($e->getMessage());
}
