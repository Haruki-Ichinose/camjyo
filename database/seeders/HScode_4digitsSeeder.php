<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HScode_4digitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('h_scode_4digits')->insert([
['HScode_4'=> '01.01','description' =>'馬'],
['HScode_4'=> '01.02','description' =>'牛'],
['HScode_4'=> '01.03','description' =>'豚'],
['HScode_4'=> '01.04','description' =>'羊、山羊'],
['HScode_4'=> '01.05','description' =>'家禽'],
['HScode_4'=> '01.06','description' =>'その他'],
['HScode_4'=> '02.01','description' =>'牛の肉（生鮮のもの及び冷蔵したものに限る。）'],
['HScode_4'=> '02.02','description' =>'牛の肉（冷凍したものに限る。）'],
['HScode_4'=> '02.03','description' =>'豚の肉（生鮮のもの及び冷蔵し又は冷凍したものに限る。）'],
['HScode_4'=> '02.04','description' =>'羊又はやぎの肉（生鮮のもの及び冷蔵し又は冷凍したものに限る。）'],
['HScode_4'=> '02.05','description' =>'馬、ろ馬、ら馬又はヒニーの肉（生鮮のもの及び冷蔵し又は冷凍したものに限る。）'],
['HScode_4'=> '02.06','description' =>'食用のくず肉（牛、豚、羊、やぎ、馬、ろ馬、ら馬又はヒニーのもので、生鮮のもの及び冷蔵し又は冷凍したものに限る。）'],
['HScode_4'=> '02.07','description' =>'肉及び食用のくず肉で、第01.05項の家きんのもの（生鮮のもの及び冷蔵し又は冷凍したものに限る。）'],
['HScode_4'=> '02.08','description' =>'その他の肉及び食用のくず肉（生鮮のもの及び冷蔵し又は冷凍したものに限る。）'],
['HScode_4'=> '02.09','description' =>'家きんの脂肪及び豚の筋肉層のない脂肪（溶出その他の方法で抽出してないもので、生鮮のもの及び冷蔵し、冷凍し、塩蔵し、塩水漬けし、乾燥し又はくん製したものに限る。）'],
['HScode_4'=> '02.10','description' =>'肉及び食用のくず肉（塩蔵し、塩水漬けし、乾燥し又はくん製したものに限る。）並びに肉又はくず肉の食用の粉及びミール'],
        ]);
        }
}
