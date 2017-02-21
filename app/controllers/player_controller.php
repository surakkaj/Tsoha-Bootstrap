<?php

class PlayerController extends BaseController {

    public static function index() {
        View::make('player/index.html');
    }

    public static function view($id) {

        View::make('player/view.html', array());
    }

    public static function login() {
        View::make('player/login.html');
    }

    public static function add() {
        View::make('player/add.html');
    }

    public static function logout() {
        $_SESSION['player'] = null;
        View::make('player/login.html');
    }

    public static function logger() {
        $posti = $_POST;
        $player = Player::auth($posti['handle'], $posti['pass']);
        if (!$player) {
            $err = array();
            $err[] =  $player . ' as a user was not found';
            View::make('player/login.html', array('errors' => $err, 'handle' => $posti['handle']));
        } else {
            $_SESSION['player'] = $player->id;
            Redirect::to('/');
        }
    }

    public static function store() {
        $posti = $_POST;
        $player = new Player(array(
            'handle' => $posti['handle'],
            'pass' => $posti['pass'],
            'email' => $posti['email']
        ));

        $err = $player->errors();
        if (count($err) > 0) {
            View::make('player/add.html', array('errors' => $err));
        } else {
            $player->save();

            Redirect::to('/player/' . $player->id . '');
        }
    }

}
