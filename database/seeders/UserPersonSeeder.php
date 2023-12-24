<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'yuu' ,
            'email' => 'exampke2@gmail.com' ,
            'email_verified_at' => new DateTime() ,
            'password' => 'Hotate',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ]);
    }
 }
