<?php

namespace Database\Seeders;

use App\Models\Squad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SquadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $squad = Squad::create([
            'squad_name'=>'tempo_squad',
            'coach_id'=>3
        ]);
        $squad2 = Squad::create([
            'squad_name'=>'rembo_squad'
        ]);
        
    }
}
