<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //データ入力
         DB::table('countries')->insert([
['name' => 'インド'],
['name' => 'インドネシア'],
['name' => '韓国'],
['name' => 'カンボジア'],
['name' => 'シンガポール'],
['name' => 'スリランカ'],
['name' => 'タイ'],
['name' => '台湾'],
['name' => '中国'],
['name' => 'バングラデシュ'],
['name' => 'パキスタン'],
['name' => 'フィリピン'],
['name' => 'ベトナム'],
['name' => '香港'],
['name' => 'マレーシア'],
['name' => 'ミャンマー'],
['name' => 'モンゴル'],
['name' => 'ラオス'],
['name' => '日本'],
['name' => 'オーストラリア'],
['name' => 'ニュージーランド'],
['name' => '北米全体'],
['name' => 'カナダ'],
['name' => '米国'],
['name' => 'アルゼンチン'],
['name' => 'ウルグアイ'],
['name' => 'キューバ'],
['name' => 'コロンビア'],
['name' => 'チリ'],
['name' => 'パラグアイ'],
['name' => 'ブラジル'],
['name' => 'ベネズエラ'],
['name' => 'ペルー'],
['name' => 'メキシコ'],
['name' => 'アイルランド'],
['name' => 'イタリア'],
['name' => '英国'],
['name' => 'オランダ'],
['name' => 'オーストリア'],
['name' => 'スイス'],
['name' => 'スウェーデン'],
['name' => 'スペイン'],
['name' => 'スロバキア'],
['name' => 'チェコ'],
['name' => 'デンマーク'],
['name' => 'ドイツ'],
['name' => 'ハンガリー'],
['name' => 'フィンランド'],
['name' => 'フランス'],
['name' => 'ベルギー'],
['name' => 'ポルトガル'],
['name' => 'ポーランド'],
['name' => 'ルーマニア'],
['name' => 'ウズベキスタン'],
['name' => 'ロシア'],
['name' => 'アラブ首長国連邦'],
['name' => 'イスラエル'],
['name' => 'イラン'],
['name' => 'サウジアラビア'],
['name' => 'トルコ'],
['name' => 'エジプト'],
['name' => 'エチオピア'],
['name' => 'ガーナ'],
['name' => 'ケニア'],
['name' => 'コートジボワール'],
['name' => 'ナイジェリア'],
['name' => '南アフリカ共和国'],
['name' => 'モザンビーク'],
['name' => 'モロッコ'],    
    // 他のデータも同様に追加
]);
    }

}
