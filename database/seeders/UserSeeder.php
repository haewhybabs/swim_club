<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'admin User',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('password'),
            'role_id'=>1,
            
        ]);
        DB::table('users')->insert([
            'name'=>'swimmer User',
            'email'=>'swimmer@swimmer.com',
            'password'=>bcrypt('password'),
            'role_id'=>3,
        ]);
        DB::table('users')->insert([
            'name'=>'Tempy Coach',
            'email'=>'coachy@gmail.com',
            'password'=>bcrypt('password'),
            'role_id'=>2,
        ]);
    }
}
