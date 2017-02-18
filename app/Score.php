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
            $all[0] = array_map("floatval", array_filter(explode(",", $score->mc), "is_numeric"));
            $all[1] = array_map("floatval", array_filter(explode(",", $score->tc), "is_numeric"));
            $all[2] = array_map("floatval", array_filter(explode(",", $score->hw), "is_numeric"));
            $all[3] = array_map("floatval", array_filter(explode(",", $score->pb), "is_numeric"));
            $all[4] = array_map("floatval", array_filter(explode(",", $score->ks), "is_numeric"));
            $all[5] = array_map("floatval", array_filter(explode(",", $score->ac), "is_numeric"));

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
}
