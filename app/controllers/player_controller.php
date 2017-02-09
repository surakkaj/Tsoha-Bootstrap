<?php

class PlayerController extends BaseController{
    public static function index(){
        View::make('player/index.html');
    }
    public static function view($id){
        
        View::make('player/view.html', array());
    }
      public static function login(){
      View::make('player/login.html');
  }
      public static function logger(){
          $posti = $_POST;
          $player = Player::auth($posti['handle'], $posti['pass']);
          if (!$player) {
              View::make('player/login.html', array('errors' => 'With the wrong credentials!?', 'handle' => $posti['handle']));
          } else {
              $_SESSION['player'] = $player->id;
              Redirect::to('/'); 
          }
  }
}