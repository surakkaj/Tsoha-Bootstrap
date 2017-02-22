<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RunController extends BaseController {

    public static function store() {
        self::check_logged_in();
        $posti = $_POST;
        $run= new Run(array(
            'track' => $posti['track'],
            'player' => $posti['player'],
            'date' => $posti['date']
        ));

        $err = $run->errors();
        if (count($err) > 0) {
            View::make('track/' . $run->track .  '/run/add.html', array('errors' => $err));
        } else {
            $track->save();

            Redirect::to('/track/' . $run->track . '');
        }
    }
        public static function destroy($id) {
        self::check_logged_in();
        $run = new Run(array('id' => $id));
        $run->delete();
        Redirect::to('/track');
    }

}
