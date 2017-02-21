<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HoleController extends BaseController {

    public static function add($trackid) {
        self::check_logged_in();
        View::make('hole/add.html', array('track' => $trackid));
    }

    public static function store_by_object($hole) {
        self::check_logged_in();


        $err = $hole->errors();
        if (count($err) > 0) {
            $hole->delete_by_track();
            View::make('hole/add.html', array('track' => $hole->track), array('errors' => $err));
        } else {
            $hole->save();
        }
    }

    public static function update_by_object($hole) {
        self::check_logged_in();


        $err = $hole->errors();
        if (count($err) > 0) {
            //
        } else {
            $hole->update();
        }
    }


}
