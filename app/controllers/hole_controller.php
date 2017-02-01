<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HoleController extends BaseController{
    public static function index(){
        $tracks = Hole::all();
        View::make('track/index.html', array('holes => $holes'));
    }
}