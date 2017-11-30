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
        $query = "SELECT cid, cname, aid, aname, sid, sname, grade FROM `ClassesWork` NATURAL JOIN Classes NATURAL JOIN Students NATURAL JOIN WeightOfGrades";
        $select = DbConn::getResults($query, []);
        if( ! $select['errored'] ) {
            $list = $select['response'];
        }
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
        $cid = $_REQUEST['cid'];
        $aid = $_REQUEST['aid'];
        $sid = $_REQUEST['sid'];
        if( isset($_REQUEST['submitted']) ) {
            $update = DbConn::update("ClassesWork", [
                'grade' => $_REQUEST['grade']
            ], "cid='$cid', aid='$aid', sid='$sid'" );
            if( ! $update['errored'] ) {
                $showForm = false;
                App::redirect("classes_work/list");
            } else {
                formatted_var_dump("TODO error reporting", $update);
            }
        }
        if( $showForm ) {
            $data = [];
                $query = "SELECT grade FROM ClassesWork WHERE cid = $cid AND aid = $aid AND sid = $sid";
                $results = DbConn::getResults($query, []);
                if( ! $results['errored'] ) {
                    $grade = $results['response'][0]['grade'];
                }
            App::display("classes_work/update.php", [
            'cid' => $cid,
            'aid' => $aid,
            'sid' => $sid,
            'grade' => $grade
            ]);
        }
    }

    public static function delete() {
        $showForm = true;
        $cid = $_REQUEST['cid'];
        $aid = $_REQUEST['aid'];
        $sid = $_REQUEST['sid'];
        if( isset($_REQUEST['submitted']) ) {
            $delete = DbConn::delete("ClassesWork", [], "cid=$cid AND aid=$aid AND sid=$sid");
            if( ! $delete['errored'] ) {
                $showForm = false;
                App::redirect("classes_work/list");
            } else {
                formatted_var_dump("TODO error reporting", $delete);
            }
        }
        if( $showForm ) {
            App::display("classes_work/delete.php", [
            'cid' => $cid,
            'aid' => $aid,
            'sid' => $sid,
            ]);
        }
    }

}
new ClassesWork();
