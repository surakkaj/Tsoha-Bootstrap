<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        echo 'Hello World!';
    }

    public static function testi($id) {

        echo 'Hello World!';
        echo 2 + 2;
        echo $id;
    }

    public static function moro() {

        View::make('moro.html');
    }

    public static function track() {

        View::make('track.html');
    }
    public static function trackadd() {

        View::make('run.html');
    }

    public static function tracks() {

        View::make('tracks.html');
    }
    public static function login() {

        View::make('login.html');
    }

}
