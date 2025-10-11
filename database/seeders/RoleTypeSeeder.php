<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('roles')->insert(array(
                        array(
                        'name' => "Admin",
                       
                        ),
                        array(
                        'name' => "Bussiness",
                        ),
                           array(
                        'name' => "Customer",
                       
                        ),
                      
));
    }
}
