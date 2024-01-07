<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ParentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parents')->insert([
            ['parent'=> '事前確認'],
            ['parent'=> '輸出条件'],
            ['parent'=> '輸出書類'],
        ]);
    }
}
