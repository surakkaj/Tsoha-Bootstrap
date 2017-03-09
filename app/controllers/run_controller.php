<?php


class RunController extends BaseController {

    public static function store() {
        self::check_logged_in();
        $posti = $_POST;
        $run= new Run(array(
            'track' => $posti['track'],
            'player' => $posti['player'],
            'date' => time()
        ));

        $err = $run->errors();
        if (count($err) > 0) {
            View::make('track/' . $run->track .  '/run/add.html', array('errors' => $err));
        } else {
            $track->save();

            Redirect::to('/track/' . $run->track . '');
        }
    }
    public static function store_by_object($run) {
        self::check_logged_in();
        $err = $run->errors();
        if (count($err) > 0) {
            View::make('track/' . $run->track .  '/run/add.html', array('errors' => $err));
        } else {
            $run->save();
        }
    }
        public static function destroy($id) {
        self::check_logged_in();
        $run = new Run(array('id' => $id));
        $run->delete();
        Redirect::to('/track');
    }

}
