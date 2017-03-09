<?php

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
