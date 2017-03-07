<?php

class Hole extends BaseModel {

    public $id, $track, $par, $length;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_par', 'validate_length');
    }

    public static function find_by_trackId($id) {
        $query = DB::connection()->prepare('SELECT * FROM Hole WHERE track = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $holes = array();
        foreach ($rows as $row) {
            $holes[] = new Hole(array(
                'id' => $row['id'],
                'par' => $row['par'],
                'length' => $row['length'],
                'track' => $row['track']
            ));
        }
        return $holes;
    }


    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Hole (track, par, length) VALUES (:track, :par, :length) RETURNING id');
        $query->execute(array('track' => $this->track, 'par' => $this->par, 'length' => $this->length));
        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Hole SET track = :track, par = :par, length = :length WHERE id = :id');
        $query->execute(array('track' => $this->track, 'par' => $this->par, 'length' => $this->length, 'id' => $this->id));
    }

    public function delete_by_track() {
        $query1 = DB::connection()->prepare('DELETE FROM Hole  WHERE track = :id');
        $query1->execute(array('id' => $this->track));
    }

    public function delete() {
        $query1 = DB::connection()->prepare('DELETE FROM Hole  WHERE id = :id');
        $query1->execute(array('id' => $this->id));
    }

    public function validate_length() {
        return $this->validate_integer($this->length);
    }

    public function validate_par() {
        return $this->validate_integer($this->par);
    }

}
