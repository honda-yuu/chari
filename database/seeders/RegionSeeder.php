<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
           'area'=>'中央区' ,
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),
           ]);
           
        DB::table('regions')->insert([
           'area'=>'北区' ,
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),
           ]);
           
        DB::table('regions')->insert([
           'area'=>'西区' ,
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),
           ]);
           
        DB::table('regions')->insert([
           'area'=>'東区' ,
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),
           ]);
           
        DB::table('regions')->insert([
           'area'=>'南区' ,
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),
           ]); 
    }
}
