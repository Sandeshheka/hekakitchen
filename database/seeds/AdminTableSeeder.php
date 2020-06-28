<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Sandesh',
            'phone' => '9860026832',
            'email' => 'hekasandyvr46@gmail.com',
            'password' => bcrypt('hk12345')

        ]);
    }
}
