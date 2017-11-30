<?php

namespace cs4430\routes;
use cs4430\App;
use cs4430\DbConn;

class WeightOfGrades {
    public function __construct() {
        App::addRoute("weight_of_grades/list",   [$this, 'list']);
        App::addRoute("weight_of_grades/insert", [$this, 'insert']);
        App::addRoute("weight_of_grades/update", [$this, 'update']);
        App::addRoute("weight_of_grades/delete", [$this, 'delete']);
    }

    public static function list() {
        $list = [];
        $query = "SELECT * FROM `WeightOfGrades`";
        $select = DbConn::getResults($query, []);
        if( ! $select['errored'] ) {
            $list = $select['response'];
        }
        App::display("weight_of_grades/list.php", [
            'list' => $list,
        ]);
    }

    public static function insert() {
        $showForm = true;
        if( isset($_REQUEST['submitted']) ) {
            $insert = DbConn::insert("WeightOfGrades", [
                'aid' => $_REQUEST['aid'],
                'cid' => $_REQUEST['cid'],
                'aname' => $_REQUEST['aname'],
                'weight' => $_REQUEST['weight'],
            ]);
            if( ! $insert['errored'] ) {
                $showForm = false;
                App::redirect("weight_of_grades/list");
            } else {
                formatted_var_dump("TODO error reporting", $insert);
            }
        }
        if( $showForm ) {
            App::display("weight_of_grades/insert.php", []);
        }
    }

    public static function update() {
	$showForm = true;
        $aid = $_REQUEST['aid'];
        if( isset($_REQUEST['submitted']) ) {
            $update = DbConn::update("WeightOfGrades", [
		'cid' => $_REQUEST['cid'],
                'aname' => $_REQUEST['aname'],
                'weight' => $_REQUEST['weight'],
            ], "aid='$aid'");
            if( ! $update['errored'] ) {
                $showForm = false;
                App::redirect("weight_of_grades/list");
            } else {
                formatted_var_dump("TODO error reporting", $update);
            }
        }
        if( $showForm ) {
            $data = [];
                $query = "SELECT cid, aname, weight FROM WeightOfGrades WHERE aid = $aid";
                $results = DbConn::getResults($query, []);
                if( ! $results['errored'] ) {
		    $cid = $results['response'][0]['cid'];
                    $aname = $results['response'][0]['aname'];
                    $weight = $results['response'][0]['weight'];
                }
            App::display("weight_of_grades/update.php", [
            'aid' => $aid,
            'cid' => $cid,
            'aname' => $aname,
            'weight' => $weight
            ]);
        }
    }

    public static function delete() {
        $showForm = true;
        $aid = $_REQUEST['aid'];
        if( isset($_REQUEST['submitted']) ) {
            $delete = DbConn::delete("WeightOfGrades", [], "aid=$aid");
            if( ! $delete['errored'] ) {
                $showForm = false;
                App::redirect("weight_of_grades/list");
            } else {
                formatted_var_dump("TODO error reporting", $delete);
            }
        }
        if( $showForm ) {
            App::display("weight_of_grades/delete.php", [
            'aid' => $aid
            ]);
        }
    }
}
new WeightOfGrades();
