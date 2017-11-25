<?php

namespace cs4430\routes\git;
use cs4430\App;

class Db {
    public function __construct() {
        App::addRoute("git/db/",        [__CLASS__, 'display']);
        App::addRoute("git/db/import",  [__CLASS__, 'import']);
        App::addRoute("git/db/export",  [__CLASS__, 'export']);
    }

    public static function display() {
        App::display("git/db.php", []);
    }

    private static function getFile() {
        return App::getDir() . 'mysql-cs4430.dmp';
    }

    public static function import() {
        $file = self::getFile();
        $cmd = "/opt/lampp/bin/mysql -u root --password= cs4430 < $file";
        $output = shell_exec($cmd);
        ob_start();
        echo "<div><a href='/'>Home</a></div>";
        echo "<p><b>$cmd</b></p>";
        $html = ob_get_clean();
        App::display("general.php", [
            'html' => $html,
        ]);
    }

    /*
     * @ref https://dev.mysql.com/doc/refman/5.7/en/mysqldump.html
     */
    public static function export() {
        // /opt/lampp/htdocs/cs4430/mysql-cs4430.dump
        $file = self::getFile();
        $cmd = "/opt/lampp/bin/mysqldump -u root --password= cs4430 > $file";
        $output = shell_exec($cmd);
        ob_start();
        echo "<div><a href='/'>Home</a></div>";
        echo "<p><b>$cmd</b></p>";
        $html = ob_get_clean();
        App::display("general.php", [
            'html' => $html,
        ]);
    }
}
new Db();
