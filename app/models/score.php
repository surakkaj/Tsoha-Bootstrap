<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Score extends BaseModel {
    
    public  $id, $run, $player_id, $throws,  $hole;
    


    public function __construct($attributes) {
        parent::__construct($attributes);
    }
}