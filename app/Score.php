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

    public static function getWeeklyRanks($student_ids) {
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

        foreach ($student_ids as $id) {
            $score = Score::where('student_id', $id)->first();
            $all = array();
            $all[0] = Score::splitScores($score->mc);
            $all[1] = Score::splitScores($score->tc);
            $all[2] = Score::splitScores($score->hw);
            $all[3] = Score::splitScores($score->pb);
            $all[4] = Score::splitScores($score->ks);
            $all[5] = Score::splitScores($score->ac);

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

    public function getSum() {
        $sum = 0;
        $sum += array_sum(Score::splitScores($this->mc));
        $sum += array_sum(Score::splitScores($this->tc));
        $sum += array_sum(Score::splitScores($this->hw));
        $sum += array_sum(Score::splitScores($this->pb));
        $sum += array_sum(Score::splitScores($this->ks));
        $sum += array_sum(Score::splitScores($this->ac));

        return $sum;
    }

    public static function getCurrentRankings() {
        $sums = array();
        foreach (Score::all() as $score) {
            $sums[] = [
                "student_id" => $score->student_id,
                "sum" => $score->getSum()
            ];
        }
        usort($sums, function($a, $b) {
            return $b['sum'] <=> $a['sum'];
        });
        return $sums;
    }

    public static function getStudentRank($student_id) {
        $rankings = Score::getCurrentRankings();
        for ($i = 0; $i < count($rankings); $i++) {
            if ($student_id == $rankings[$i]["student_id"]) {
                return $i;
            }
        }
        return -1;
    }

    public static function getTopSteven() {
        $topSteven = array_slice(Score::getCurrentRankings(), 0, 7);
        $student_ids = array();
        foreach ($topSteven as $top) {
            $student_ids[] = $top["student_id"];
        }
        return $student_ids;
    }

    public static function getTopStevenAndCurrent($student_id) {
        $topSteven = Score::getTopSteven();
        $student_rank = Score::getStudentRank($student_id);
        $allRankings = Score::getCurrentRankings();
        $arr = $topSteven;
        if ($student_rank >= 7) {
            //at rank 9 or below
            if ($student_rank > 7) {
                $arr[] = $allRankings[$student_rank - 1]["student_id"];
            }
            $arr[] = $allRankings[$student_rank]["student_id"];
            //at rank 49 or above
            if ($student_rank < count($allRankings) - 1) {
                $arr[] = $allRankings[$student_rank + 1]["student_id"];
            }
        }
        return $arr;
    }
}
