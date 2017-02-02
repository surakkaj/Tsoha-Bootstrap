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
    
        public static function findByTrackId($id){
        $query = DB::connection()->prepare('SELECT * FROM Hole WHERE track = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $holes = array();
        foreach ($rows as $row){
            $holes[] = new Hole(array(
                'id' => $row['id'],
                'par' => $row['par'],
                'length' => $row['length'],
                'track' => $row['track']
                
            ));
            
        }
        return $holes;
    }
    
}