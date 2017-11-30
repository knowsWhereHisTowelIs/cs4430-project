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
        App::addRoute("students/assignment_grade", [$this, 'assignment_grade']);
    }

    public static function assignment_grade() {
        $sid = $_REQUEST['sid'];
        $query = "SELECT sid, sname, aid, aname, cid, cname, grade FROM Students
            NATURAL JOIN ClassesWork
            NATURAL JOIN Enrolled
            NATURAL JOIN Classes
            NATURAL JOIN WeightOfGrades
            WHERE sid = $sid";
        $results = DbConn::getResults($query, []);
        if( ! $results['errored'] ) {
            $list = $results['response'];
        } else {
            $list = [];
        }
        App::display("students/assignment_grade.php", [
            'list' => $list
        ]);
    }

    public static function classes_enrolled() {
        $sid = $_REQUEST['sid'];
        $query = "SELECT sid, sname, cid, cname FROM Students
            NATURAL JOIN Enrolled
            NATURAL JOIN Classes
            WHERE sid = $sid";
        $results = DbConn::getResults($query, []);
        if( ! $results['errored'] ) {
            $list = $results['response'];
        } else {
            $list = [];
        }
        App::display("students/classes_enrolled.php", [
            'list' => $list
        ]);
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
        $sid = $_REQUEST['sid'];
        if( isset($_REQUEST['submitted']) ) {
            $delete = DbConn::delete("Students", [], "sid=$sid");
            if( ! $delete['errored'] ) {
                $showForm = false;
                App::redirect("students/list");
            } else {
                formatted_var_dump("TODO error reporting", $delete);
            }
        }
        if( $showForm ) {
            App::display("students/delete.php", ['sid' => $sid]);
        }
    }
}
new Students();
