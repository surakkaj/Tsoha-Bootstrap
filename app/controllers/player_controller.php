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
    public static function view(){
        View::make('player/view.html');
    }
}