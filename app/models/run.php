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
        
        $this->validators = array();
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Run (track, playerid, playdate) VALUES (:track, :playerid, :playdate) RETURNING id');
        $query->execute(array('track' => $this->track, 'playerid' => $this->player, 'length' => $this->date));
        $row = $query->fetch();

        $this->id = $row['id'];
    }



    public function delete() {
        $query1 = DB::connection()->prepare('DELETE FROM Score WHERE run = :id');
        $query1->execute(array('id' => $this->id));
        $query2 = DB::connection()->prepare('DELETE FROM Run WHERE id = :id');
        $query2->execute(array('id' => $this->id));
    }
}