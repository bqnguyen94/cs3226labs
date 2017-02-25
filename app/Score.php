<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;

class Score extends Model
{
    protected $fillable = ['student_id', 'mc', 'tc', 'hw', 'pb', 'ks', 'ac'];
    protected $primaryKey = 'student_id';

    public function student() {
        return $this->belongsTo('Student');
    }

    public static function getWeeklyRanks() {
        //$scores = array();

        $data = array();
        $data["student_name"] = array();
        $data["rank"] = array();
        $data["scores"] = array();
        $k = 0;
        $data[] = array();
        $data[] = array();
        $data[] = array();
        $data[] = array();

        foreach (Score::all() as $score) {
            $all = array();
            $all[0] = Score::splitScores($score->mc);
            $all[1] = Score::splitScores($score->tc);
            $all[2] = Score::splitScores($score->hw);
            $all[3] = Score::splitScores($score->pb);
            $all[4] = Score::splitScores($score->ks);

            $max = max([count($all[0]), count($all[1]), count($all[2]), count($all[3]), count($all[4]), count($all[5])]);

            //$weekSums = array();
            for ($i = 0; $i < $max; $i++) {
                $sum = 0;
                for ($j = 0; $j < count($all); $j++) {
                    if ($i < count($all[$j])) {
                        $sum += $all[$j][$i];
                    }
                }
                if ($k == 0) {
                    $data["scores"][] = array();
                }
                if ($i > 0) {
                    $data["scores"][$i][$k] = $sum + $data["scores"][$i - 1][$k];
                } else {
                    $data["scores"][$i][$k] = $sum;
                }
                //$weekSums[] = $sum;
            }
            $data["student_name"][] = Student::where('id', $score->student_id)->first()->name;
            $k++;
            //$scores[] = $weekSums;
        }
        for ($i = 0; $i < count($data["scores"]); $i++) {
            $data["rank"][] = array();
            $temp = $data["scores"][$i];
            rsort($temp);
            foreach($data["scores"][$i] as $score) {
                foreach($temp as $key => $value) {
                    if ($value === $score) {
                        $data["rank"][$i][] = $key + 1;
                        unset($temp[$key]);
                        break;
                    }
                }
            }
        }
        return $data;
        /*for ($j = 0; $j < 4; $j++) {
            $temp = array();
            for ($i = 0; $i < count(Score::all()); $i++) {
                $temp[] = $scores[$i][$j];
            }
            rsort($temp);

            for ($i = 0; $i < count(Score::all()); $i++) {
                foreach ($temp as $key => $value) {
                    if ($scores[$i][$j] === $value) {
                        $data["rank"][$j][] = $key;
                        break;
                    }
                }
            }
        }

        $fp = fopen('../weeklyRanks.json', 'w');
        fwrite($fp, json_encode($data));
        fclose($fp);*/
    }

    private static function splitScores($arrStr) {
        $scores = array();
        foreach (explode(",", $arrStr) as $item) {
            if (is_numeric($item)) {
                $scores[] = $item;
            } else {
                $scores[] = 0;
            }
        }
        return array_map("floatval", $scores);
    }
}
