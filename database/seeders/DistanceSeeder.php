<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('distances')->insert([
            'name'=>'50M'
        ]);

        DB::table('distances')->insert([
            'name'=>'100M'
        ]);

        DB::table('distances')->insert([
            'name'=>'200M'
        ]);

        DB::table('distances')->insert([
            'name'=>'400M'
        ]);

        DB::table('distances')->insert([
            'name'=>'1500M'
        ]);

        DB::table('distances')->insert([
            'name'=>'10000M'
        ]);



        
    }
}
