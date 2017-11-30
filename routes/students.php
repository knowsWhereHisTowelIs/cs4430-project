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
        App::addRoute("students/classes_enrolled", [$this, 'classes_enrolled']);
    }

    public static function classes_enrolled() {
        $showForm = true;
        $cname = "This student isn't enrolled for any classes";
        if( isset($_REQUEST['submitted']) ) {
            $sid = $_REQUEST['sid'];
            $classes_enrolled = DbConn::getResults("SELECT DISTINCT cname FROM Students, Enrolled, Classes
                WHERE Enrolled.cid=Classes.cid AND Enrolled.sid=$sid", []);
            if( ! $classes_enrolled['errored'] ) {
                $cname = $classes_enrolled['response'][0]['cname'];
            }
        }
        App::display("classes/classes_enrolled.php", ['cname' => $cname]);
    }

    public static function list() {
        $list = [];
        $query = "SELECT * FROM `Students`";
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
            $insert = DbConn::insert("Students", [
                'sname' => $_REQUEST['sname'],
                'status' => $_REQUEST['status'],
            ]);
            if( ! $insert['errored'] ) {
                $showForm = false;
                App::redirect("students/list");
            } else {
                formatted_var_dump("TODO error reporting", $insert);
            }
        }
        if( $showForm ) {
            App::display("students/insert.php", []);
        }
    }

    public static function update() {
        $showForm = true;
        $sid = $_REQUEST['sid'];
        if( isset($_REQUEST['submitted']) ) {
            $update = DbConn::update("Students", [
                'sname' => $_REQUEST['sname'],
                'status' => $_REQUEST['status']
            ], "sid='$sid'" );
            if( ! $update['errored'] ) {
                $showForm = false;
                App::redirect("students/list");
            } else {
                formatted_var_dump("TODO error reporting", $update);
            }
        }
        if( $showForm ) {
            $data = [];
            if( $sid != null ) {
                $query = "SELECT * FROM Students WHERE sid = $sid";
                $results = DbConn::getResults($query, []);
                if( ! $results['errored'] ) {
                    $data = $results['response'][0];
                }
            }
            App::display("students/update.php", $data);
        }
    }

    public static function delete() {
        $showForm = true;
        if( isset($_REQUEST['submitted']) ) {
        $sid=3;
            $delete = DbConn::delete("Students", [], "sid=$sid");
            if( ! $delete['errored'] ) {
                $showForm = false;
                App::redirect("students/list");
            } else {
                formatted_var_dump("TODO error reporting", $delete);
            }
        }
        if( $showForm ) {
            App::display("students/delete.php", []);
        }
    }
}
new Students();
