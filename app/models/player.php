<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Player extends BaseModel {
    
    public  $id, $handle, $pass, $email;
    


    public function __construct($attributes) {
        parent::__construct($attributes);
    }
}