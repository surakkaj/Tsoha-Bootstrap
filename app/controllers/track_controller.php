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

    public static function edit($id) {
        self::check_logged_in();
        $track = Track::find($id);
        $hole = Hole::find_by_trackId($id);
        View::make('track/edit.html', array('track' => $track, 'holes' => $hole));
    }

    public static function update() {
        self::check_logged_in();
        $posti = $_POST;
        Kint::dump($posti);
        $track = new Track(array(
            'id' => (int)$posti['trackid'],
            'track' => $posti['track'],
            'location' => $posti['location'],
            'length' => (int)$posti['tlength']
        ));

        $err = $track->errors();
        if (count($err) > 0) {
            View::make('track/edit.html', array('errors' => $err, 'track' => $track));
        } else {
            $track->update();
            self::update_holes();
            Redirect::to('/track/' . $track->id . '');
        }
    }

    public static function update_holes() {
        $posti = $_POST;

        for ($i = 0; $i < sizeof($posti['par']); $i++) {
            if ((empty($posti['par']) && empty($posti['length']))) {
                continue;
            }
            $hole = new Hole(array(
                 'id' => (int) $posti['id'][$i],
                'track' => (int)$posti['trackid'],
                'par' => (int) $posti['par'][$i],
                'length' => (int) $posti['length'][$i]
               
            ));
            HoleController::update_by_object($hole);
        }
    }

    public static function destroy($id) {
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
        if (count($err) > 0) {
            View::make('track/add.html', array('errors' => $err));
        } else {
            $track->save();

            Redirect::to('/track/' . $track->id . '');
        }
    }

    public static function add() {
        View::make('track/add.html');
    }

    public static function holes($id) {
        $posti = $_POST;

        for ($i = 0; $i < sizeof($posti['par']); $i++) {
            if ((empty($posti['par']) && empty($posti['length']))) {
                continue;
            }
            $hole = new Hole(array(
                'track' => (int) $id,
                'par' => (int) $posti['par'][$i],
                'length' => (int) $posti['length'][$i]
            ));
            HoleController::store_by_object($hole);
        }
        Redirect::to('/track/' . $id);
    }

}
