<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'=>'admin','role'=>User::ROLE_ADMIN,'password'=>bcrypt('123456'),'email' => 'admin@unicorn.com'
        ]);

        User::create([
            'name'=>'mod','role'=>User::ROLE_MODERATOR,'password'=>bcrypt('123456'),'email' => 'mod@unicorn.com'
        ]);

        User::create([
            'name'=>'user','role'=>User::ROLE_USER,'password'=>bcrypt('123456'),'email' => 'user@unicorn.com'
        ]);
    }
}
