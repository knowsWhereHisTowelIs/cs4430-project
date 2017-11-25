<?php

namespace cs4430\routes;
use cs4430\App;
use cs4430\DbConn;

class Students {
    public function __construct() {
        App::addRoute("students/list",   [$this, 'list']);
        App::addRoute("students/insert", [$this, 'insert']);
        App::addRoute("students/update", [$this, 'update']);
        App::addRoute("students/delete", [$this, 'delete']);
    }

    public static function list() {
        $list = [];
        $query = "SELECT * FROM `students`";
        $select = DbConn::getResults($query, []);
        if( ! $select['errored'] ) {
            $list = $select['response'];
        }
        App::display("students/list.php", [
            'list' => $list,
        ]);
    }

    public static function insert() {
        $showForm = true;
        if( isset($_REQUEST['submitted']) ) {
            $sid = $_REQUEST['sid'];
            $insert = DbConn::insert("students", [
                'sid' => $sid,
            ]);
            if( ! $insert['errored'] ) {
                $showForm = false;
                App::redirect("students/list");
            }
        }
        if( $showForm ) {
            App::display("students/insert.php", []);
        }
    }

    public static function update() {
        App::display("students/update.php", []);
    }

    public static function delete() {
        App::display("students/delete.php", []);
    }
}
new Students();
