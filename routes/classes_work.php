<?php

namespace cs4430\routes;
use cs4430\App;
use cs4430\DbConn;

class ClassesWork {
    public function __construct() {
        App::addRoute("classes_work/list",   [$this, 'list']);
        App::addRoute("classes_work/insert", [$this, 'insert']);
        App::addRoute("classes_work/update", [$this, 'update']);
        App::addRoute("classes_work/delete", [$this, 'delete']);
        App::addRoute("classes_work/assignment_grade", [$this, 'assignment_grade']);
    }

    public static function assignment_grade() {
        $showForm = true;
        $grade = "n/a";
        if( isset($_REQUEST['submitted']) ) {
	    $cid = $_REQUEST['cid'];
            $aid = $_REQUEST['aid'];
            $sid = $_REQUEST['sid'];
            $assignment_grade = DbConn::getResults("SELECT grade FROM ClassesWork WHERE cid=$cid AND aid=$aid AND sid=$sid ", []);
            if( ! $assignment_grade['errored'] ) {
                $grade = $assignment_grade['response'][0]['grade'];
            }
        }
            App::display("classes_work/assignment_grade.php", ['grade' => $grade]); 
    }
    
    public static function list() {
        $list = [];
        $query = "SELECT * FROM `ClassesWork`";
        $select = DbConn::getResults($query, []);
        if( ! $select['errored'] ) {
            $list = $select['response'];
        }
        formatted_var_dump($select);
        App::display("classes_work/list.php", [
            'list' => $list,
        ]);
    }

    public static function insert() {
        $showForm = true;
        if( isset($_REQUEST['submitted']) ) {
            $insert = DbConn::insert("ClassesWork", [
                'cid' => $_REQUEST['cid'],
                'aid' => $_REQUEST['aid'],
                'sid' => $_REQUEST['sid'],
                'grade' => $_REQUEST['grade'],
            ]);
            if( ! $insert['errored'] ) {
                $showForm = false;
                App::redirect("classes_work/list");
            } else {
                formatted_var_dump("TODO error reporting", $insert);
            }
        }
        if( $showForm ) {
            App::display("classes_work/insert.php", []);
        }
    }

    public static function update() {
	$showForm = true;
	
        App::display("classes_work/update.php", []);
    }

    public static function delete() {
        $showForm = true;
        if( isset($_REQUEST['submitted']) ) {
        $cid=6;
        $aid=1;
        $sid=2;
            $delete = DbConn::delete("ClassesWork", [], "cid=$cid AND aid=$aid AND sid=$sid");
            if( ! $delete['errored'] ) {
                $showForm = false;
                App::redirect("classes_work/list");
            } else {
                formatted_var_dump("TODO error reporting", $delete);
            }
        }
        if( $showForm ) {
            App::display("classes_work/delete.php", []);
        }
    }
    
}
new ClassesWork();
 
 
