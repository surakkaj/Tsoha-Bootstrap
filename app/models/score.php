<?php


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

    public static function find_by_runId($id) {
        $query = DB::connection()->prepare('SELECT * FROM Score WHERE run = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $score = array();
        foreach ($rows as $row) {
            $score[] = new Score(array(
                'id' => $row['id'],
                'run' => $row['run'],
                'player' => $row['playerid'],
                'hole' => $row['holeid'],
                'throws' => $row['throws']
            ));
        }
        return $score;
    }

    public static function find_by_player($pid) {
        $query = DB::connection()->prepare('SELECT * FROM Score WHERE playerid = :pid ');
        $query->execute(array('pid' => $pid));
        $rows = $query->fetchAll();
        $score = array();
        foreach ($rows as $row) {

            $score[] = new Score(array(
                'id' => $row['id'],
                'run' => $row['run'],
                'player' => $row['playerid'],
                'hole' => $row['holeid'],
                'throws' => $row['throws']
            ));
        }
        return $score;
    }
        public static function find_track_by_player($tid, $pid) {
        $query = DB::connection()->prepare('SELECT Score.throws, Score.run, Player.id  FROM Score INNER JOIN Player ON Score.playerid=Player.id WHERE Score.playerid = :pid');
        $query->execute(array( 'pid' => $pid));
        $rows = $query->fetchAll();
        $scores = array();
        foreach ($rows as $row) {
            $scores[] = new Score(array(
                 'id' => $row['id'],
                'run' => $row['run'],
                'throws' => $row['throws']
            ));
        }
        return $scores;
    }


}
