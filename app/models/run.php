<?php



class Run extends BaseModel {

    public $id, $track, $player, $date;

    public function __construct($attributes) {
        parent::__construct($attributes);

        $this->validators = array();
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Run WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $run = new Run(array(
                'id' => $row['id'],
                'track' => $row['track'],
                'player' => $row['playerid'],
                'track' => $row['track']
            ));

            return $run;
        }
        return null;
    }

    public static function find_by_trackId($id) {
        $query = DB::connection()->prepare('SELECT * FROM Run WHERE track = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $runs = array();
        foreach ($rows as $row) {
            $runs[] = new Run(array(
                'id' => $row['id'],
                'track' => $row['track'],
                'player' => $row['playerid'],
                'track' => $row['track']
            ));
        }
        return $runs;
    }

    public static function find_by_trackId_array($id) {
        $query = DB::connection()->prepare('SELECT * FROM Run WHERE track = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $runs = array();
        foreach ($rows as $row) {
            $runs[] = $row['id'];
         }
        return $runs;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Run (track, playerid, playdate) VALUES (:track, :playerid, :playdate) RETURNING id');
        $query->execute(array('track' => $this->track, 'playerid' => $this->player, 'playdate' => $this->date));
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
