<?php


class Track extends BaseModel {

    public $id, $track, $location, $length;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_trackname', 'validate_location', 'validate_length');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Track');
        $query->execute();
        $rows = $query->fetchAll();
        $tracks = array();
        foreach ($rows as $row) {
            $tracks[] = new Track(array(
                'id' => $row['id'],
                'location' => $row['location'],
                'length' => $row['length'],
                'track' => $row['trackname']
            ));
        }
        return $tracks;
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Track WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $track = new Track(array(
                'id' => $row['id'],
                'location' => $row['location'],
                'length' => $row['length'],
                'track' => $row['trackname']
            ));

            return $track;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Track (trackname, location, length) VALUES (:track, :location, :length) RETURNING id');
        $query->execute(array('track' => $this->track, 'location' => $this->location, 'length' => $this->length));
        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Track SET trackname = :track, location = :location, length = :length WHERE id = :id');
        $query->execute(array('track' => $this->track, 'location' => $this->location, 'length' => $this->length, 'id' => $this->id));
    }

    public function delete() {
        $runs = Run::find_by_trackId($this->id);
        foreach ($runs as $run){
            $run->delete();
        }
        $query1 = DB::connection()->prepare('DELETE FROM Hole  WHERE track = :id');
        $query1->execute(array('id' => $this->id));
        $query2 = DB::connection()->prepare('DELETE FROM Track  WHERE id = :id');
        $query2->execute(array('id' => $this->id));
    }

    public function validate_trackname() {
        return $this->validate_min_length($this->track, 3);
    }

    public function validate_location() {
        return $this->validate_min_length($this->location, 3);
    }

    public function validate_length() {
        return $this->validate_integer($this->length);
    }

    public function get_par() {
        $holes = Hole::find_by_trackId($this->id);
        if (empty($holes)) {
            return null;
        } else {
            $par = 0;
            foreach ($holes as $hole) {
                $par+=$hole->par;
            }
            return $par;
        }
    }

    public function get_length() {
        $holes = Hole::find_by_trackId($this->id);
        if (empty($holes)) {
            return null;
        } else {
            $length = 0;
            foreach ($holes as $hole) {
                $length+=$hole->length;
            }
            return $length;
        }
    }

}
