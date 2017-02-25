<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Student;
use App\Score;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller {

    public function batch() {
        if (!Auth::check() || Auth::user()->role != User::ROLE_ADMIN) {
            Session::flash('error', "In the name of all those that are holy you are forbidden!");
            return Redirect::to('/');
        }

        $students = Student::orderBy('name')->get();
        return view('batch')->with('students', $students);
    }

    public function index() {
        $students = Student::all();
        $scoresDB = array();
        foreach(Score::all() as $score) {
            $mcs = array_map("floatval", array_filter(explode(",", $score->mc), "is_numeric"));
            $tcs = array_map("floatval", array_filter(explode(",", $score->tc), "is_numeric"));
            $hws = array_map("floatval", array_filter(explode(",", $score->hw), "is_numeric"));
            $pbs = array_map("floatval", array_filter(explode(",", $score->pb), "is_numeric"));
            $kss = array_map("floatval", array_filter(explode(",", $score->ks), "is_numeric"));
            $acs = array_map("floatval", array_filter(explode(",", $score->ac), "is_numeric"));
            $scoresDB[] = [
                'student_id' => $score->student_id,
                'mc' => $mcs,
                'tc' => $tcs,
                'hw' => $hws,
                'pb' => $pbs,
                'ks' => $kss,
                'ac' => $acs,
            ];
        }
        $updated_at = Score::all()->sortByDesc('updated_at')->first()->updated_at;
        $scores_updated_at = Score::all()->sortByDesc('updated_at')->first()->updated_at;
        if (strtotime($updated_at) < strtotime($scores_updated_at)) {
            $updated_at = $scores_updated_at;
        }
        return view('index')
                ->with('students', $students)
                ->with('scoresDB', $scoresDB)
                ->with('updated_at', $updated_at);
    }

    public function chart() {
        return view('chart')->with('data', Score::getWeeklyRanks());
    }

    public function achievements() {
        $data = array();
        $data[] = array();
        foreach (DB::table('achievements')->get() as $item) {
            $data[] = array();
            $data["achievements"][] = [
                "id" => $item->id,
                "name" => $item->achievement_name,
            ];
        }
        foreach (DB::table('student_achievement')->get() as $item) {
            $data[$item->achievement_id][] = [
                "student_id" => $item->student_id,
                "student_name" => Student::where('id', $item->student_id)->first()->name,
            ];
        }
        return view('achievements')->with('data', $data);
    }

    private function findTopStudent() {

        $curTopScore = 0;
        $topStudent = array();
        foreach(Score::all() as $score) {
            $mcs = array_map("floatval", array_filter(explode(",", $score->mc), "is_numeric"));
            $tcs = array_map("floatval", array_filter(explode(",", $score->tc), "is_numeric"));
            $hws = array_map("floatval", array_filter(explode(",", $score->hw), "is_numeric"));
            $pbs = array_map("floatval", array_filter(explode(",", $score->pb), "is_numeric"));
            $kss = array_map("floatval", array_filter(explode(",", $score->ks), "is_numeric"));
            $acs = array_map("floatval", array_filter(explode(",", $score->ac), "is_numeric"));
            $thisTopScore = array_sum($mcs) + array_sum($tcs) + array_sum($hws) + array_sum($pbs) + array_sum($kss) + array_sum($acs);
            if ($curTopScore < $thisTopScore) {
                $topStudent = [
                    'name' => Student::where('id', $score->student_id)
                                                ->first()
                                                ->name,
                    'mc' => array_sum($mcs),
                    'tc' => array_sum($tcs),
                    'hw' => array_sum($hws),
                    'pb' => array_sum($pbs),
                    'ks' => array_sum($kss),
                    'ac' => array_sum($acs),
                ];
                $curTopScore = $thisTopScore;
            }
        }

        return $topStudent;
    }

    public function detail($id) {
        $student = Student::where('id', $id)->first();
        if (!$student) {
            Session::flash('error', "Student record does not exists!");
            return Redirect::to('/');
        }
        $score = Score::where('student_id', $id)->first();
        $mcs = explode(",", $score->mc);
        $tcs = explode(",", $score->tc);
        $hws = explode(",", $score->hw);
        $pbs = explode(",", $score->pb);
        $kss = explode(",", $score->ks);
        $acs = explode(",", $score->ac);
        $scores = [
            'mc' => $mcs,
            'tc' => $tcs,
            'hw' => $hws,
            'pb' => $pbs,
            'ks' => $kss,
            'ac' => $acs,
        ];
        $allAchievements = DB::table('achievements')
                            ->orderBy('id')
                            ->get();
        $achievements = DB::table('student_achievement')
                            ->select(DB::raw('count(*) as cnt, achievement_id'))
                            ->where('student_id', $id)
                            ->groupBy('achievement_id')
                            ->orderBy('achievement_id')
                            ->get();
        return view('student.detail')
                    ->with('student', $student)
                    ->with('scores', $scores)
                    ->with('topStudent', $this->findTopStudent())
                    ->with('achievements', $achievements)
                    ->with('allAchievements', $allAchievements);
    }

    public function edit($id) {
        if (!Auth::check() || Auth::user()->role == User::ROLE_USER) {
            Session::flash('error', "In the name of all those that are holy you are forbidden!");
            return Redirect::to('/');
        }
        $student = Student::where('id', $id)->first();
        if (!$student) {
            Session::flash('error', "Student record does not exists!");
            return Redirect::to('/');
        }
        $score = Score::where('student_id', $id)->first();
        $achievements = DB::table('student_achievement')
                            ->where('student_id', $id)
                            ->orderBy('achievement_id')
                            ->get();
        $allAchievements = DB::table('achievements')
                            ->orderBy('id')
                            ->get();
        return view('student.edit')
                    ->with('student', $student)
                    ->with('score', $score)
                    ->with('achievements', $achievements)
                    ->with('allAchievements', $allAchievements);
    }

    public function create() {
        if (!Auth::check() || Auth::user()->role != User::ROLE_ADMIN) {
            Session::flash('error', "In the name of all those that are holy you are forbidden!");
            return Redirect::to('/');
        }
        return view('student.create');
    }

    public function check(Request $request) {
        if (!Auth::check() || Auth::user()->role != User::ROLE_ADMIN) {
            Session::flash('error', "In the name of all those that are holy you are forbidden!");
            return Redirect::to('/');
        }
        $validator = $this->makeNameValidator($request);

        if ($validator->fails()) {
            return redirect('create')->withErrors($validator)->withInput();
        } else {
            return $this->store($request);
        }
    }

    public function checkBatch(Request $request) {
        if (!Auth::check() || Auth::user()->role != User::ROLE_ADMIN) {
            Session::flash('error', "In the name of all those that are holy you are forbidden!");
            return Redirect::to('/');
        }

        $scores = $request->get('scores');
        $category = $request->get('category');
        $week = $request->get('week');

        if (!$this->validateScoresBatch($request)) {
            Session::flash('error', "There seems to be one or many invalid scores entered!");
            return Redirect::back()->withInput();
        }

        $i = 0;
        foreach (Student::orderBy('name')->get() as $student) {
            $score = Score::where('student_id', $student->id)->first();
            $temp = explode(",", $score->$category);
            $temp[$week - 1] = $scores[$i];
            $score->$category = implode(",", $temp);
            $score->save();
            $i++;
        }

        Session::flash('alert-success', "Batch scores added successfully!");
        return Redirect::to('/');
    }

    private function validateScoresBatch(Request $request) {
        $scores = $request->get('scores');
        $category = $request->category;
        $week = $request->week;

        if ($category === "mc" || $category === "tc" || $category === "hw") {
            foreach ($scores as $score) {
                if (is_numeric($score)) {
                    if (fmod($score, 0.5) !== 0.0 || $score > 4.0) {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        } else {
            foreach ($scores as $score) {
                if (is_numeric($score)) {
                    if (!ctype_digit($score) || $score > 4) {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        }
        return true;
    }

    public function checkEdit(Request $request, $id) {
        if (!Auth::check() || Auth::user()->role == User::ROLE_USER) {
            Session::flash('error', "In the name of all those that are holy you are forbidden!");
            return Redirect::to('/');
        }

        $validator = $this->makeNameValidator($request);
        $scoresCheck = $this->validateScores($request);
        $achievementsCheck = $this->validateAchievements($request);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } elseif (!$scoresCheck) {
            Session::flash('error', "Please ensure the scores are in correct format.");
            return Redirect::back()->withInput();
        } elseif (!$achievementsCheck) {
            Session::flash('error', "Pls lah! An achievement got more stars than it should already.");
            return Redirect::back()->withInput();
        } else {
            $student = Student::where('id', $id)->first();
            $score = Score::where('student_id', $id)->first();

            $iso3 = "OTT";
            if ($request->country !== "OT") {
                $iso3_codes = json_decode(file_get_contents('../iso3.json'), true);
                $iso3 = $iso3_codes[$request->country];
            }

            $image = $student->image;
            $file = $request->file('image');
            if ($file) {
                $destinationPath = 'img/icons/';
                $filename = (string) ($id) . ".png";
                $file->move($destinationPath, $filename);
                $image = '/' . $destinationPath . $filename;
            }

            $student->name = $request->name;
            $student->nick = $request->nick;
            $student->kattis = $request->kattis;
            $student->country_iso2 = $request->country;
            $student->country_iso3 = $iso3;
            $student->image = $image;

            $student->save();

            $score->mc = implode(",", $request->get('mc'));
            $score->tc = implode(",", $request->get('tc'));
            $score->hw = implode(",", $request->get('hw'));
            $score->pb = implode(",", $request->get('pb'));
            $score->ks = implode(",", $request->get('ks'));

            $ac_types = $request->get('ac_types');
            $ac_weeks = $request->get('ac_weeks');
            $ac_reasons = $request->get('ac_reasons');

            $temp = array();
            for ($i = 0; $i < 8; $i++) {
                $temp[] = "x";
                $count = 0;
                for ($j = 0; $j < count($ac_weeks); $j++) {
                    if ($ac_weeks[$j] == $i + 1) {
                        $count++;
                        $temp[$i] = (string) $count;
                    }
                }
            }
            $score->ac = implode(",", $temp);

            $score->save();

            DB::table('student_achievement')->where('student_id', $id)->delete();

            for ($i = 0; $i < count($ac_types); $i++) {
                DB::table('student_achievement')->insert([
                    'student_id' => $id,
                    'achievement_id' => $ac_types[$i],
                    'week' => $ac_weeks[$i],
                    'reason' => $ac_reasons[$i],
                ]);
            }

            Session::flash('alert-success', $student->name . "'s profile updated!");
            return Redirect::to('student/' . $id);
        }
    }

    private function validateAchievements(Request $request) {
        $ac_types = $request->get('ac_types');
        $freq = array_count_values($ac_types);
        $allAchievements = DB::table('achievements')
                            ->select(DB::raw('id, max_stars'))
                            ->orderBy('id')
                            ->get();
        for ($i = 1; $i <= count($allAchievements); $i++) {
            if ($freq[$i] && $freq[$i] > $allAchievements->where('id', $i)->first()->max_stars) {
                return false;
            }
        }
        return true;
    }

    private function validateScores(Request $request) {

        $mc = $request->get('mc');
        $tc = $request->get('tc');
        $hw = $request->get('hw');
        $pb = $request->get('pb');
        $ks = $request->get('ks');
        $ac = $request->get('ac');

        foreach ($mc as $var) {
            if (is_numeric($var)) {
                if (fmod($var, 0.5) !== 0.0 || $var > 4.0) {
                    return false;
                }
            } elseif ($var !== "x.y") {
                return false;
            }
        }

        foreach ($tc as $var) {
            if (is_numeric($var)) {
                if (fmod($var, 0.5) !== 0.0 || $var > 4.0) {
                    return false;
                }
            } elseif ($var !== "xy.z") {
                return false;
            }
        }

        foreach ($hw as $var) {
            if (is_numeric($var)) {
                if (fmod($var, 0.5) !== 0.0 || $var > 4.0) {
                    return false;
                }
            } elseif ($var !== "x.y") {
                return false;
            }
        }

        foreach ($pb as $var) {
            if (is_numeric($var)) {
                if (!ctype_digit($var) || $var > 4) {
                    return false;
                }
            } elseif ($var !== "x") {
                return false;
            }
        }

        foreach ($ks as $var) {
            if (is_numeric($var)) {
                if (!ctype_digit($var) || $var > 4) {
                    return false;
                }
            } elseif ($var !== "x") {
                return false;
            }
        }

        return true;
    }

    private function makeNameValidator(Request $request) {
        $rules = [
            'nick' => 'required|min:4|max:30',
            'name' => 'required|min:4|max:30',
            'kattis' => 'required|min:4|max:30',
            'country' => 'required'
        ];

        $messages = [
            'nick.required' => 'Every awesome people has a nick name.',
            'nick.min' => 'Your nick name may be awesome but it\'s too bloody damn short!',
            'nick.max' => 'Your nick name may be awesome but it\'s too bloody damn long!!!!!',
            'name.required' => 'You have a name don\'t you ?!',
            'name.min' => 'Your name is too damn short!',
            'name.max' => 'Unless your name is Uvuvwevwevwe Onyetenyevwe Ugwemuhwem Osas, it\'s too bloody damn long!!!!!',
            'kattis.required' => 'Every awesome people also has a Kattis account.',
            'kattis.min' => 'Your Kattis account name is too short and that\'s just not right!',
            'kattis.max' => 'Your Kattis account name is too long and that\'s just not right!',
            'country.required' => 'Oi what\'s your nationality lah. Don\'t be shy.',
        ];

        return Validator::make($request->only(['nick', 'name', 'kattis', 'country']), $rules, $messages);
    }

    private function store(Request $request) {

        $nick = $request->input('nick');
        $name = $request->input('name');
        $kattis = $request->input('kattis');
        $country = $request->input('country');
        $image = '/img/icons/default.png';

        $iso3 = "OTT";
        if ($country !== "OT") {
            $iso3_codes = json_decode(file_get_contents('../iso3.json'), true);
            $iso3 = $iso3_codes[$country];
        }

        $student = Student::create([
            'nick' => $nick,
            'name' => $name,
            'kattis' => $kattis,
            'image' => $image,
            'country_iso2' => $country,
            'country_iso3' => $iso3,
        ]);

        $id = $student->id;

        $file = $request->file('image');
        if ($file) {
            $destinationPath = 'img/icons/';
            $filename = (string) ($id) . ".png";
            $file->move($destinationPath, $filename);
            $image = '/' . $destinationPath . $filename;
            $student->image = $image;
            $student->save();
        }

        Score::create([
            'student_id' => $id,
        ]);

        return Redirect::to('student/' . $id);
    }

    public function destroy($id) {
        if (!Auth::check() || Auth::user()->role != User::ROLE_ADMIN) {
            Session::flash('error', "In the name of all those that are holy you are forbidden!");
            return Redirect::to('/');
        }


        $student = Student::findOrFail($id);
        if ($student) {
            Session::flash('alert-success', $student->name . "'s record deleted!");
            $student->delete();

        } else {
            Session::flash('error', "Student record does not exists!");
        }

        return Redirect::to('/');
    }

    /*
    public function fillscores() {
        $studentDB = unserialize(file_get_contents('../students.txt'));

        foreach ($studentDB as $entry) {
            $student = Student::create([
                'name' => $entry["name"],
                'nick' => $entry["nick"],
                'image' => $entry["image"],
                'kattis' => $entry["kattis"],
                'country_iso2' => $entry["country_iso2"],
                'country_iso3' => $entry["country_iso3"],
            ]);

            $mc = $this->implodeToString($entry["scores"]["mc"], "x.y", 9);
            $tc = $this->implodeToString($entry["scores"]["tc"], "xy.z", 2);
            $hw = $this->implodeToString($entry["scores"]["hw"], "x.y", 10);
            $pb = $this->implodeToString($entry["scores"]["pb"], "x", 9);
            $ks = $this->implodeToString($entry["scores"]["ks"], "x", 12);
            $ac = $this->implodeToString($entry["scores"]["ac"], "x", 8);

            Score::create([
                'student_id' => $student->id,
                'mc' => $mc,
                'tc' => $tc,
                'hw' => $hw,
                'pb' => $pb,
                'ks' => $ks,
                'ac' => $ac
            ]);
        }

        /*foreach (Student::all() as $student) {
            $id = $student->id;

            $mcs = (array_slice((array) DB::table('mcs')->where('student_id', $id)->first(), 2, 9));
            $tcs = (array_slice((array) DB::table('tcs')->where('student_id', $id)->first(), 2, 2));
            $hws = (array_slice((array) DB::table('hws')->where('student_id', $id)->first(), 2, 10));
            $pbs = (array_slice((array) DB::table('pbs')->where('student_id', $id)->first(), 2, 9));
            $kss = (array_slice((array) DB::table('kss')->where('student_id', $id)->first(), 2, 12));
            $acs = (array_slice((array) DB::table('acs')->where('student_id', $id)->first(), 2, 8));

            $mcs = $this->implodeToString($mcs, "x.y");
            $tcs = $this->implodeToString($tcs, "xy.z");
            $hws = $this->implodeToString($hws, "x.y");
            $pbs = $this->implodeToString($pbs, "x");
            $kss = $this->implodeToString($kss, "x");
            $acs = $this->implodeToString($acs, "x");

            Score::create([
                'student_id' => $id,
                'mc' => $mcs,
                'tc' => $tcs,
                'hw' => $hws,
                'pb' => $pbs,
                'ks' => $kss,
                'ac' => $acs,
            ]);
        }
    }

    private function implodeToString($arr, $placeHolder, $len) {
        $str = "";
        for ($i = 0; $i < $len; $i++) {
            if ($i < count($arr)) {
                $str .= $arr[$i] . ",";
            } else {
                $str .= $placeHolder . ",";
            }
        }

        return rtrim($str, ",");
    }

    /*public function implodeToString($arr, $def) {
        $keys = array_keys($arr);
        $str = "";
        for ($i = 0; $i < count($arr); $i++) {
            if (!isset($arr[$keys[$i]])) {
                $str .= $def . ",";
            } else {
                $str .= $arr[$keys[$i]] . ",";
            }
        }
        return rtrim($str, ",");
    }*/

    /*public function removetests() {
        unset($this->studentDB[count($this->studentDB) - 1]);
        array_values($this->studentDB);
        $this->updateDB();
    }*/

/*    public function filltable() {

        for ($i = 0; $i < 50; $i++) {
            $scores = $this->studentDB[$i]["scores"];
            DB::table('acs')->insert([
                'student_id' => $i + 1,
                '01' => $scores["ac"][0],
                '02' => $scores["ac"][1],
                '03' => $scores["ac"][2],
            ]);
        }

    }*/
}
?>
