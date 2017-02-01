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
    
        public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Track WHERE id = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetch();
        $hole = array();
        if ($row){
            $hole[] = new Game(array(
                'id' => $row['id'],
                'location' => $row['location'],
                'length' => $row['length'],
                'track' => $row['track'],
                
            ));
            
        }
        return $hole;
    }
    
}