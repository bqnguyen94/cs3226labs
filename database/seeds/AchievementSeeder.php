<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('achievements')->insert([
            'achievement_name' => 'Let it begins',
            'max_stars' => 1,
        ]);
        DB::table('achievements')->insert([
            'achievement_name' => 'Quick starter',
            'max_stars' => 1,
        ]);
        DB::table('achievements')->insert([
            'achievement_name' => 'Active in class',
            'max_stars' => 3,
        ]);
        DB::table('achievements')->insert([
            'achievement_name' => 'Surprise us',
            'max_stars' => 3,
        ]);
        DB::table('achievements')->insert([
            'achievement_name' => 'High determination',
            'max_stars' => 1,
        ]);
        DB::table('achievements')->insert([
            'achievement_name' => 'Bookworm',
            'max_stars' => 1,
        ]);
        DB::table('achievements')->insert([
            'achievement_name' => 'Kattis apprentice',
            'max_stars' => 6,
        ]);
        DB::table('achievements')->insert([
            'achievement_name' => 'CodeForces Specialist',
            'max_stars' => 1,
        ]);
    }
}
