<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ScoreController extends BaseController {

    public static function store_by_object($score) {
        self::check_logged_in();
        $err = $score->errors();
        if (count($err) > 0) {
            //
        } else {
            $score->save();
        }
    }

}
