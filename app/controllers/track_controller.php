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

    public static function view($id) {
        $track = Track::find($id);
        $hole = Hole::findByTrackId($id);
        if (empty($hole)) {
            Redirect::to('track' .$id . '/add');
        }
        View::make('track/view.html', array('track' => $track, 'holes' => $hole));
    }
    public static function store(){
        $posti = $_POST;
        $track = new Track(array(
            'trackname' => $posti['trackname'],
            'location' => $posti['location'],
            'length' => $posti['length']
        ));
        $track->save();

       Redirect::to('/track/' . $track->id);
    }
    public static function add(){
        View::make('track/add.html');
    }

}
