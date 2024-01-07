<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Child extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('children')->insert([
            ['parents_id'=> '1','child'=> '認定・FDAなど'],
            ['parents_id'=> '1','child'=> '輸出先で商品受け取りに関して'],
            ['parents_id'=> '2','child'=> '動物・植物検疫検査'],
            ['parents_id'=> '2','child'=> '貿易協定'],
            ['parents_id'=> '2','child'=> '添加物・残留農薬など'],
            ['parents_id'=> '2','child'=> '制限品目（放射性物質等）'],
            ['parents_id'=> '3','child'=> '輸出者'],
            ['parents_id'=> '3','child'=> '輸入者'],
            ['parents_id'=> '3','child'=> '仕入れ先'],
            ['parents_id'=> '3','child'=> '輸送会社'],
        ]);
    }
}
