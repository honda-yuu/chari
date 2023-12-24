<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('contacts')->insert([
             'user_id' => 1 ,
             'name' => 'hoonnda',
             'body' => '○○駐車場の料金が違ってませんか。' ,
             'created_at' => new DateTime(),
             'updated_at' => new DateTime(),
             ]);
    }
}
