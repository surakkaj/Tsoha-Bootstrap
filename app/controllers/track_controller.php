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
    public static function edit(){
        self::check_logged_in();
        $track = Track::find($id);
        View::make('track/edit.html', array('attr' => $game));
    }
    public static function update(){
        self::check_logged_in();
        $posti = $_POST;
        $track = new Track(array(
            'track' => $posti['track'],
            'location' => $posti['location'],
            'length' => $posti['length']
        ));

        $err = $track->errors();
        if (count($err)  > 0) {
            View::make('track/edit.html', array('errors' => $err,'track' => $track));
            
        } else {
             $track->update();

            Redirect::to('/track/' . $track->id . '');

        }
    }
    public static function destroy($id){
        self::check_logged_in();
        $track = new Track(array('id' => $id));
        $track->delete();
        Redirect::to('/track');
    }
    

    public static function view($id) {
        $track = Track::find($id);
        $hole = Hole::find_by_trackId($id);
        if (empty($hole)) {
            Redirect::to('/track/' . $id . '/add');
        }
        View::make('track/view.html', array('track' => $track, 'holes' => $hole));
    }

    public static function store() {
        self::check_logged_in();
        $posti = $_POST;
        $track = new Track(array(
            'track' => $posti['track'],
            'location' => $posti['location'],
            'length' => $posti['length']
        ));

        $err = $track->errors();
        if (count($err)  > 0) {
            View::make('track/add.html', array('errors' => $err));
            
        } else {
             $track->save();

            Redirect::to('/track/' . $track->id . '');

        }
    }

    public static function add() {
        View::make('track/add.html');
    }
    public static function holes($id){
        $params = $_POST;
        kint::dump($params);
    }

}
