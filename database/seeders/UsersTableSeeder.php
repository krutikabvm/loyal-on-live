<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin account
         DB::table('users')->insert([
            'name' => "admin",
            'type' => "1", #admin 
            'email' => "abcabc@abc.com",
            'password' => bcrypt('123123123'),
        ]);
    }
}
