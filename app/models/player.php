<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Player extends BaseModel {

    public $id, $handle, $pass, $email;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function auth($handle, $pass) {
        $query = DB::connection()->prepare('SELECT * FROM Player WHERE handle = :handle AND pass = :pass LIMIT 1');
        $query->execute(array('handle' => $handle, 'pass' => $pass));
        $row = $query->fetch();
        if ($row) {
            $player = new Player(array(
                'id' => $row['id'],
                'handle' => $row['handle'],
                'email' => $row['email']
            ));

            return $player;
        } else {
            return null;
        }
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM player WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $player = new Player(array(
                'id' => $row['id'],
                'handle' => $row['handle'],
                'email' => $row['email']
            ));

            return $player;
        } else {
            return null;
        }
    }

}
