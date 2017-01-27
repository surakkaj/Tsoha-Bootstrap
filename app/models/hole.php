<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Hole extends BaseModel {
    
    public  $id, $track, $par, $length;
    


    public function __construct($attributes) {
        parent::__construct($attributes);
    }
}