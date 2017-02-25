<?php

use Illuminate\Database\Seeder;
use App\Student;
use App\Score;

class StudentsAndScoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 50;

        $iso3_codes = json_decode(file_get_contents('iso3.json'), true);

        for ($i = 1; $i <= $limit; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $name = $firstName . " " . $lastName;
            $kattis = strtolower($firstName);
            $image = "/img/icons/" . (string) ($i) . ".png";
            $country_iso2 = $faker->countryCode;
            $country_iso3 = $iso3_codes[$country_iso2];

            $mc = "";
            for ($j = 0; $j < 9; $j++) {
                if ($j < 3) {
                    $mc .= number_format($faker->numberBetween($min = 0, $max = 8) * 0.5, 1) . ",";
                } else {
                    $mc .= 'x.y,';
                }
            }
            $mc = rtrim($mc, ",");

            $tc = "";
            for ($j = 0; $j < 2; $j++) {
                $tc .= number_format($faker->numberBetween($min = 0, $max = 8) * 0.5, 1) . ",";
            }
            $tc = rtrim($tc, ",");

            $hw = "";
            for ($j = 0; $j < 10; $j++) {
                if ($j < 2) {
                    $hw .= number_format($faker->numberBetween($min = 0, $max = 4) * 0.5, 1) . ",";
                } else {
                    $hw .= 'x.y,';
                }
            }
            $hw = rtrim($hw, ",");

            $pb = "";
            for ($j = 0; $j < 9; $j++) {
                if ($j < 3) {
                    $pb .= $faker->numberBetween($min = 0, $max = 1) . ",";
                } else {
                    $pb .= 'x,';
                }
            }
            $pb = rtrim($pb, ",");

            $ks = "";
            for ($j = 0; $j < 12; $j++) {
                if ($j < 4) {
                    $ks .= $faker->numberBetween($min = 0, $max = 1) . ",";
                } else {
                    $ks .= 'x,';
                }
            }
            $ks = rtrim($ks, ",");

            $student = Student::create([
                'nick' => $kattis,
                'name' => $name,
                'kattis' => $kattis,
                'image' => $image,
                'country_iso2' => $country_iso2,
                'country_iso3' => $country_iso3,
            ]);

            Score::create([
                'student_id' => $student->id,
                'mc' => $mc,
                'tc' => $tc,
                'hw' => $hw,
                'pb' => $pb,
                'ks' => $ks,
            ]);
        }
    }
}
