<?php

class Player extends BaseModel {

    public $id, $handle, $pass, $email;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_handle', 'validate_pass', 'validate_email');
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

    public function validate_email() {
        return $this->validate_contains($this->email, '@');
    }

    public function validate_nonadmin() {
        if ($this->email == "admin") {
            return false;
        }
        return true;
    }

    public function validate_pass() {
        return $this->validate_min_length_hide($this->pass, 7);
    }

    public function get_best_to_track($tid) {

        $scored = Score::find_by_player($this->id);
        $runs = Run::find_by_trackId_array($tid);
        $scores = array();
        foreach ($scored as $score) {
            if (in_array($score->run, $runs)) {
                $scores[] = $score;
            }
        }
        $return = array();
        foreach ($scores as $score) {
            if (isset($return[$score->run])) {
                $return[$score->run] += $score->throws;
            } else {
                $return[$score->run] = $score->throws;
            }
        }
        if (empty($return)) {
            return 0;
        }
        return min($return);
    }

    public function get_runs_to_track($tid) {
        $runs = Run::find_by_track_player($tid, $this->id);


        return count($runs);
    }

    public function get_throws_to_track($tid) {
        $scored = Score::find_by_player($this->id);
        $runs = Run::find_by_trackId_array($tid);
        $scores = array();
        $throws = 0;
        foreach ($scored as $score) {
            if (in_array($score->run, $runs)) {
                $scores[] = $score;
                $throws += $score->throws;
            }
        }
        return $throws;
    }

    public function get_best_to_hole($hid) {
        $score = Score::best_hole_by_player($hid, $this->id);
        return $score->throws;
    }

    public function get_avg_to_track($tid) {

        $scored = Score::find_by_player($this->id);
        $runs = Run::find_by_trackId_array($tid);
        $scores = array();
        foreach ($scored as $score) {
            if (in_array($score->run, $runs)) {
                $scores[] = $score;
            }
        }
        $return = array();
        foreach ($scores as $score) {
            if (isset($return[$score->run])) {
                $return[$score->run] += $score->throws;
            } else {
                $return[$score->run] = $score->throws;
            }
        }
        if (empty($return)) {
            return 0;
        }
        return array_sum($return) / count($return);
    }

    public function get_avg_to_hole($hid) {
        
    }

}
