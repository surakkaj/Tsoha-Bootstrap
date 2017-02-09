<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
              View::make('user/login.html', array('error' => 'With the wrong credentials!?', 'handle' => $posti['handle']));
          } else {
              Redirect::to('/'); 
          }
  }
}