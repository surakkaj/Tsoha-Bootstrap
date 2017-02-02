<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TrackController extends BaseController {

    public static function index() {
        $tracks = Track::all();
        View::make('track/index.html', array('tracks' => $tracks));
    }

    public static function show($id) {
        $track = Track::find($id);
        View::make('track/index.html', array('track' => $track));
    }

}
