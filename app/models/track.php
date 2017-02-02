<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Track extends BaseModel {
    
    public  $id, $track, $location, $length;
    


    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
      public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Track');
        $query->execute();
        $rows = $query->fetchAll();
        $tracks = array();
        foreach ($rows as $row){
            $tracks[] = new Track(array(
                'id' => $row['id'],
                'location' => $row['location'],
                'length' => $row['length'],
                'track' => $row['trackname']
                
            ));
            
        }
        return $tracks;
    }
      public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Track WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        $tracks = array();
        if ($row){
            $tracks[] = new Track(array(
                'id' => $row['id'],
                'location' => $row['location'],
                'length' => $row['length'],
                'track' => $row['trackname'],
                
            ));
            
        }
        return $tracks;
    }
    
}