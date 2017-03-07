<?php

class BaseController {

    public static function get_user_logged_in() {
        if (isset($_SESSION['player'])) {
            $player_id = $_SESSION['player'];
            $player = Player::find($player_id);
            return $player;
        }
        return null;
    }

    public static function check_logged_in() {
        if (!isset($_SESSION['player'])) {
            $err[] = 'You should log in first';
            Redirect::to('/login', array('errors' => $err));
        }
    }

    public static function check_admin() {
        if (!isset($_SESSION['admin'])) {
            $err[] = 'Admins only';
            Redirect::to('/login', array('errors' => $err));
        }
    }

}
