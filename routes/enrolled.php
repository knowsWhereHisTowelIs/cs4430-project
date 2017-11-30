<?php

namespace cs4430\routes;
use cs4430\App;
use cs4430\DbConn;

class Enrolled {
    public function __construct() {
        App::addRoute("enrolled/list",   [$this, 'list']);
        App::addRoute("enrolled/insert", [$this, 'insert']);
        App::addRoute("enrolled/delete", [$this, 'delete']);
    }

    public static function list() {
        $list = [];
        $query = "SELECT * FROM `Enrolled`";
        $select = DbConn::getResults($query, []);
        if( ! $select['errored'] ) {
            $list = $select['response'];
        }
        App::display("enrolled/list.php", [
            'list' => $list,
        ]);
    }

    public static function insert() {
        $showForm = true;
        if( isset($_REQUEST['submitted']) ) {
            $insert = DbConn::insert("Enrolled", [
                'sid' => $_REQUEST['sid'],
                'cid' => $_REQUEST['cid'],
            ]);
            if( ! $insert['errored'] ) {
                $showForm = false;
                App::redirect("enrolled/list");
            } else {
                formatted_var_dump("TODO error reporting", $insert);
            }
        }
        if( $showForm ) {
            App::display("enrolled/insert.php", []);
        }
    }

    public static function delete() {
        $showForm = true;
        $sid = $_REQUEST['sid'];
        $cid = $_REQUEST['cid'];
        if( isset($_REQUEST['submitted']) ) {  
            $delete = DbConn::delete("Enrolled", [], "sid=$sid AND cid=$cid");
            if( ! $delete['errored'] ) {
                $showForm = false;
                App::redirect("enrolled/list");
            } else {
                formatted_var_dump("TODO error reporting", $delete);
            }
        }
        if( $showForm ) {
            App::display("enrolled/delete.php", ['sid' => $sid, 'cid' => $cid]);
        }
    }

}
new Enrolled();
