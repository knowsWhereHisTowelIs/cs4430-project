<?php

namespace cs4430\routes;
use cs4430\App;
use cs4430\DbConn;

class Teachers {
    public function __construct() {
        App::addRoute("teachers/list",   [$this, 'list']);
        App::addRoute("teachers/insert", [$this, 'insert']);
        App::addRoute("teachers/update", [$this, 'update']);
        App::addRoute("teachers/delete", [$this, 'delete']);
    }

    public static function list() {
        $list = [];
        $query = "SELECT * FROM `Teachers`";
        $select = DbConn::getResults($query, []);
        if( ! $select['errored'] ) {
            $list = $select['response'];
        }
        App::display("teachers/list.php", [
            'list' => $list,
        ]);
    }

    public static function insert() {
        $showForm = true;
        if( isset($_REQUEST['submitted']) ) {
            $insert = DbConn::insert("Teachers", [
                'tname' => $_REQUEST['tname'],
                'position' => $_REQUEST['position'],
            ]);
            if( ! $insert['errored'] ) {
                $showForm = false;
                App::redirect("teachers/list");
            } else {
                formatted_var_dump("TODO error reporting", $insert);
            }
        }
        if( $showForm ) {
            App::display("teachers/insert.php", []);
        }
    }

    public static function update() {
	$showForm = true;

        App::display("teachers/update.php", []);
    }

    public static function delete() {
        $showForm = true;
        if( isset($_REQUEST['submitted']) ) {
        $tid=4;
            $delete = DbConn::delete("Teachers", [], "tid=$tid");
            if( ! $delete['errored'] ) {
                $showForm = false;
                App::redirect("teachers/list");
            } else {
                formatted_var_dump("TODO error reporting", $delete);
            }
        }
        if( $showForm ) {
            App::display("teachers/delete.php", []);
        }
    }
}
new Teachers();
