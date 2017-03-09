<?php


class HoleController extends BaseController {

    public static function add($trackid) {
        self::check_admin();
        View::make('hole/add.html', array('track' => $trackid));
    }

    public static function store_by_object($hole) {
        self::check_admin();


        $err = $hole->errors();
        if (count($err) > 0) {
            $hole->delete_by_track();
            View::make('hole/add.html', array('track' => $hole->track), array('errors' => $err));
        } else {
            $hole->save();
        }
    }

    public static function update_by_object($hole) {
        self::check_admin();


        $err = $hole->errors();
        if (count($err) > 0) {
            View::make('hole/add.html', array('track' => $hole->track), array('errors' => $err));
        } else {
            $hole->update();
        }
    }

}
