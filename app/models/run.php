<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Run extends BaseModel {
    
    public  $id, $track, $player, $date;
    


    public function __construct($attributes) {
        parent::__construct($attributes);
    }
}