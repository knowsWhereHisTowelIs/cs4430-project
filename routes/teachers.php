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

    public static function update()  {
        $showForm = true;
        $tid = $_REQUEST['tid'];
        if( isset($_REQUEST['submitted']) ) {
            $update = DbConn::update("Teachers", [
                'tname' => $_REQUEST['tname'],
                'position' => $_REQUEST['position']
            ], "tid='$tid'" );
            if( ! $update['errored'] ) {
                $showForm = false;
                App::redirect("teachers/list");
            } else {
                formatted_var_dump("TODO error reporting", $update);
            }
        }
        if( $showForm ) {
            $data = [];
            if( $tid != null ) {
                $query = "SELECT * FROM Teachers WHERE tid = $tid";
                $results = DbConn::getResults($query, []);
                if( ! $results['errored'] ) {
                    $data = $results['response'][0];
                }
            }
            App::display("teachers/update.php", $data);
        }
    }

    public static function delete() {
        $showForm = true;
        $tid = $_REQUEST['tid'];
        if( isset($_REQUEST['submitted']) ) {
            $delete = DbConn::delete("Teachers", [], "tid=$tid");
            if( ! $delete['errored'] ) {
                $showForm = false;
                App::redirect("teachers/list");
            } else {
                formatted_var_dump("TODO error reporting", $delete);
            }
        }
        if( $showForm ) {
            App::display("teachers/delete.php", ['tid' => $tid]);
        }
    }
}
new Teachers();
