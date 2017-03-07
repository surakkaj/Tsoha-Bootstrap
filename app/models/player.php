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
        $this->validators = array('validate_handle', 'validate_pass');
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

    public function save() {
        /*
         * pass should be crypted
         */
        $query = DB::connection()->prepare('INSERT INTO Player (handle, pass, email) VALUES (:handle, :pass, :email) RETURNING id');
        $query->execute(array('handle' => $this->handle, 'pass' => $this->pass, 'email' => $this->email));
        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function delete() {
        $query1 = DB::connection()->prepare('DELETE FROM Player  WHERE id = :id');
        $query1->execute(array('id' => $this->id));
    }

    public function validate_handle() {
        return $this->validate_min_length($this->handle, 3);
    }

    public function validate_nonadmin() {
        if ($this->email == "admin") {
            return false;
        }
        return true;
    }

    public function validate_pass() {
        return $this->validate_min_length($this->pass, 7);
    }

    public static function get_best_to_track($tid) {
        
    }

    public static function get_best_to_hole($hid) {
        
    }

    public static function get_avg_to_track($tid) {
        
    }

    public static function get_avg_to_hole($hid) {
        
    }

}
