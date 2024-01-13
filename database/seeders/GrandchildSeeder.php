<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrandchildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grandchildren')->insert([
            ['parent_id'=> '1','child_id'=> '1','grandchild'=> '施設認定'],
            ['parent_id'=> '1','child_id'=> '1','grandchild'=> 'FDA登録'],
            ['parent_id'=> '1','child_id'=> '1','grandchild'=> '届け出提出'],
            ['parent_id'=> '2','child_id'=> '2','grandchild'=> '輸入ライセンス、輸入パーミットなど'],
            ['parent_id'=> '2','child_id'=> '2','grandchild'=> '輸入者側に事前確認が必要な項目'],
            ['parent_id'=> '2','child_id'=> '2','grandchild'=> '輸入者側で必要な手続き'],
            ['parent_id'=> '2','child_id'=> '3','grandchild'=> '輸入警告（インポートアラート)'],
            ['parent_id'=> '2','child_id'=> '3','grandchild'=> '検疫検査/輸出検疫証明書'],
            ['parent_id'=> '2','child_id'=> '4','grandchild'=> 'WTO, EPAなどの貿易協定'],
            ['parent_id'=> '2','child_id'=> '4','grandchild'=> 'HSコード/関税率'],
            ['parent_id'=> '2','child_id'=> '5','grandchild'=> '食品添加物規制'],
            ['parent_id'=> '2','child_id'=> '5','grandchild'=> '残留農薬規制'],
            ['parent_id'=> '2','child_id'=> '5','grandchild'=> '重金属および汚染物質'],
            ['parent_id'=> '2','child_id'=> '5','grandchild'=> '食品包装'],
            ['parent_id'=> '2','child_id'=> '6','grandchild'=> '制限品目（放射性物質等）'],
            ['parent_id'=> '2','child_id'=> '6','grandchild'=> 'ラベル表示'],
            ['parent_id'=> '2','child_id'=> '6','grandchild'=> '衛生管理、予防管理、食品安全法など'],
            ['parent_id'=> '3','child_id'=> '7','grandchild'=> '輸出者で必要な書類'],
            ['parent_id'=> '3','child_id'=> '8','grandchild'=> '輸入者で必要な書類'],
            ['parent_id'=> '3','child_id'=> '9','grandchild'=> '仕入れ先で必要な書類'],
            ['parent_id'=> '3','child_id'=> '9','grandchild'=> '輸送会社で必要な書類'],
        ]);
    }
}
