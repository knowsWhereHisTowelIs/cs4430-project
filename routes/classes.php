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
        $query = "SELECT cid, cname, tid, tname, subject FROM `Classes` NATURAL JOIN Teachers ORDER BY tid";
        $select = DbConn::getResults($query, []);
        if( ! $select['errored'] ) {
            $list = $select['response'];
        }
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
        $cid = $_REQUEST['cid'];
        if( isset($_REQUEST['submitted']) ) {
            $update = DbConn::update("Classes", [
                'tid' => $_REQUEST['tid'],
                'cname' => $_REQUEST['cname'],
                'subject' => $_REQUEST['subject'],
            ], "cid='$cid'" );
            if( ! $update['errored'] ) {
                $showForm = false;
                App::redirect("classes/list");
            } else {
                formatted_var_dump("TODO error reporting", $update);
            }
        }
        if( $showForm ) {
            $data = [];
            if( $cid != null ) {
                $query = "SELECT * FROM Classes WHERE cid = $cid";
                $results = DbConn::getResults($query, []);
                if( ! $results['errored'] ) {
                    $data = $results['response'][0];
                }
            }
            App::display("classes/update.php", $data);
        }
    }

    public static function delete() {
        $showForm = true;
        $cid = $_REQUEST['cid'];
        if( isset($_REQUEST['submitted']) ) {
            $delete = DbConn::delete("Classes", [], "cid=$cid");
            if( ! $delete['errored'] ) {
                $showForm = false;
                App::redirect("classes/list");
            } else {
                formatted_var_dump("TODO error reporting", $delete);
            }
        }
        if( $showForm ) {
            App::display("classes/delete.php", [
                'cid' => $cid,
            ]);
        }
    }

    public static function students_in_class() {
        $showForm = true;
        $cid = $_REQUEST['cid'];
        $query = "SELECT cid, cname, sid, sname FROM Classes NATURAL JOIN Enrolled NATURAL JOIN Students WHERE cid = $cid";
        $results = DbConn::getResults($query, []);
        if( ! $results['errored'] ) {
            $list = $results['response'];
        } else {
            $list = [];
        }
        //TODO unique enrolled (cid, sid)
        App::display("classes/students_in_class.php", [
            'list' => $list
        ]);
    }
}
new Classes();
