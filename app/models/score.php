<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Score extends BaseModel {

    public $id, $run, $player, $throws, $hole;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array();
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Score (run, playerid, throws, holeid) VALUES (:run, :playerid, :throws, :holeid) RETURNING id');
        $query->execute(array('run' => $this->run, 'playerid' => $this->player, 'throws' => $this->throws, 'holeid' => $this->hole));
        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Score SET run = :run, player = :player, throws = :throws, hole = :holes WHERE id = :id');
        $query->execute(array('run' => $this->run, 'player' => $this->player, 'throws' => $this->throws, 'hole' => $this->hole));
    }

}
