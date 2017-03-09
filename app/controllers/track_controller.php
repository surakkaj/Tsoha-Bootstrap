<?php


class TrackController extends BaseController {

    public static function index() {
        $tracks = Track::all();
        View::make('track/index.html', array('tracks' => $tracks));
    }

    public static function edit($id) {
        self::check_admin();
        $track = Track::find($id);
        $hole = Hole::find_by_trackId($id);
        View::make('track/edit.html', array('track' => $track, 'holes' => $hole));
    }

    public static function update() {
        self::check_admin();
        $posti = $_POST;
        $track = new Track(array(
            'id' => (int) $posti['trackid'],
            'track' => $posti['track'],
            'location' => $posti['location'],
            'length' => (int) $posti['tlength']
        ));

        $err = $track->errors();
        if (count($err) > 0) {
            View::make('track/edit.html', array('errors' => $err, 'track' => $track));
        } else {
            $track->update();
            self::update_holes();
            Redirect::to('/track/' . $track->id . '');
        }
    }

    public static function update_holes() {
        self::check_admin();
        $posti = $_POST;

        for ($i = 0; $i < sizeof($posti['par']); $i++) {
            if ((empty($posti['par']) && empty($posti['length']))) {
                continue;
            }
            $hole = new Hole(array(
                'id' => (int) $posti['id'][$i],
                'track' => (int) $posti['trackid'],
                'par' => (int) $posti['par'][$i],
                'length' => (int) $posti['length'][$i]
            ));
            HoleController::update_by_object($hole);
        }
    }

    public static function destroy($id) {
        self::check_admin();
        $track = new Track(array('id' => $id));
        $track->delete();
        Redirect::to('/track');
    }

    public static function view($id) {
        $track = Track::find($id);
        $hole = Hole::find_by_trackId($id);
        $player = self::get_user_logged_in();
        if (empty($hole)) {
            Redirect::to('/track/' . $id . '/add');
        }

        View::make('track/view.html', array('track' => $track, 'holes' => $hole, 'player' => $player));
    }

    public static function store() {
        self::check_admin();
        $posti = $_POST;
        $track = new Track(array(
            'track' => $posti['track'],
            'location' => $posti['location'],
            'length' => $posti['length']
        ));

        $err = $track->errors();
        if (count($err) > 0) {
            View::make('track/add.html', array('errors' => $err));
        } else {
            $track->save();

            Redirect::to('/track/' . $track->id . '');
        }
    }

    public static function add() {
        View::make('track/add.html');
    }

    public static function holes($id) {
        self::check_admin();
        $posti = $_POST;

        for ($i = 0; $i < sizeof($posti['par']); $i++) {
            if ((empty($posti['par']) && empty($posti['length']))) {
                continue;
            }
            $hole = new Hole(array(
                'track' => (int) $id,
                'par' => (int) $posti['par'][$i],
                'length' => (int) $posti['length'][$i]
            ));
            HoleController::store_by_object($hole);
        }
        Redirect::to('/track/' . $id);
    }

    public static function run($id) {
        self::check_logged_in();
        $track = Track::find($id);
        $holes = Hole::find_by_trackId($id);
        View::make('run/add.html', array('track' => $track, 'holes' => $holes));
    }

    public static function view_run($id, $rid) {
        self::check_logged_in();
        $track = Track::find($id);
        $holes = Hole::find_by_trackId($id);

        $run = Run::find($rid);
        if (empty($run) || $run->track != $track->id) {
            self::run($id);
        }
        $scores = Score::find_by_runId($run->id);
        View::make('run/view.html', array('track' => $track, 'holes' => $holes, 'run' => $run, 'scores' => $scores));
    }

    public static function store_run($id) {
        self::check_logged_in();
        $posti = $_POST;
        $player = self::get_user_logged_in();
        $track = Track::find($id);
        $date = date('Y-m-d H:i:s');
        $run = new Run(array(
            'track' => $track->id,
            'player' => $player->id,
            'date' => $date
        ));
        RunController::store_by_object($run);
        for ($i = 0; $i < sizeof($posti['holeid']); $i++) {
            if ((empty($posti['holeid']) && empty($posti['throws']))) {
                continue;
            }
            $score = new Score(array(
                'run' => $run->id,
                'player' => $player->id,
                'hole' => (int) $posti['holeid'][$i],
                'throws' => (int) $posti['throws'][$i]
            ));
            ScoreController::store_by_object($score);
        }
        Redirect::to('/track/' . $id);
    }

}
