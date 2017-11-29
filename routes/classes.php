<?php

namespace cs4430\routes;
use cs4430\App;
use cs4430\DbConn;

class Classes {
    public function __construct() {
        App::addRoute("classes/list",   [$this, 'list']);
        App::addRoute("classes/insert", [$this, 'insert']);
        App::addRoute("classes/update", [$this, 'update']);
        App::addRoute("classes/delete", [$this, 'delete']);
        App::addRoute("classes/students_in_class", [$this, 'students_in_class']);
    }

    public static function list() {
        $list = [];
        $query = "SELECT * FROM `Classes`";
        $select = DbConn::getResults($query, []);
        if( ! $select['errored'] ) {
            $list = $select['response'];
        }
        formatted_var_dump($select);
        App::display("classes/list.php", [
            'list' => $list,
        ]);
    }

    public static function insert() {
        $showForm = true;
        if( isset($_REQUEST['submitted']) ) {
            $insert = DbConn::insert("Classes", [
                'tid' => $_REQUEST['tid'],
                'cname' => $_REQUEST['cname'],
                'subject' => $_REQUEST['subject'],
            ]);
            if( ! $insert['errored'] ) {
                $showForm = false;
                App::redirect("classes/list");
            } else {
                formatted_var_dump("TODO error reporting", $insert);
            }
        }
        if( $showForm ) {
            App::display("classes/insert.php", []);
        }
    }

    public static function update() {
	$showForm = true;
	
        App::display("classes/update.php", []);
    }

    public static function delete() {
        $showForm = true;
        if( isset($_REQUEST['submitted']) ) {
        $cid=1;
            $delete = DbConn::delete("Classes", [], "cid=$cid");
            if( ! $delete['errored'] ) {
                $showForm = false;
                App::redirect("classes/list");
            } else {
                formatted_var_dump("TODO error reporting", $delete);
            }
        }
        if( $showForm ) {
            App::display("classes/delete.php", []);
        }
    }  
   
    public static function students_in_class() {
        $showForm = true;
        $sname = "none";
        if( isset($_REQUEST['submitted']) ) {
	    $cid = $_REQUEST['cid'];
            $students_in_class = DbConn::getResults("SELECT DISTINCT sname FROM Students, Enrolled, Classes
            WHERE Enrolled.sid=Students.sid AND Enrolled.cid=$cid", []);
            if( ! $students_in_class['errored'] ) {
	      $sname = $students_in_class['response'][0]['sname'];
            }
        }
            App::display("classes/students_in_class.php", ['sname' => $sname]);
    }
}
new Classes();
 
