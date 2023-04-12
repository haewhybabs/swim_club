<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StrokeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('strokes')->insert([
            'name'=>'Freestyle'
        ]);
        DB::table('strokes')->insert([
            'name'=>'Front Crawl'
        ]);
        DB::table('strokes')->insert([
            'name'=>'Backstroke'
        ]);
        DB::table('strokes')->insert([
            'name'=>'Breaststroke'
        ]);

        DB::table('strokes')->insert([
            'name'=>'Butterfly stroke'
        ]);

        DB::table('strokes')->insert([
            'name'=>'Sidestroke'
        ]);
    }
}
