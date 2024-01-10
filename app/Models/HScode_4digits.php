<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HScode_4digits extends Model
{
    use HasFactory;

    public static function get2digit($string)
    {   
        $string =  '0' . $string;
        return self::where( 'HScode_4', 'like', $string . '%')
                   ->orderBy('id', 'asc')
                   ->get();
    }

    public static function get4digit_TableContents($string)
    {   
        return self::where( 'HScode_4', '=', $string)
                   ->orderBy('id', 'asc')
                   ->first();
    }

    public function getText($type)
    {
        switch ($type) {
            case 1:
                return "動物（生きているものに限る。）";
            case 2:
                return "肉及び食用のくず肉";
            case 3:
                return "魚並びに甲殻類、軟体動物及びその他の水棲無脊椎動物";
            case 4:
                return "酪農品、鳥卵、天然はちみつ及び他の類に該当しない食用の動物性生産品";
            case 5:
                return "動物性生産品（他の類に該当するものを除く。）";
            case 6:
                return "生きている樹木その他の植物及びりん茎、根その他これらに類する物品並びに切花及び装飾用の葉";
            case 7:
                return "食用の野菜、根及び塊茎";
            case 8:
                return "食用の果実及びナット、かんきつ類の果皮並びにメロンの皮";
            case 9:
                return "コーヒー、茶、マテ及び香辛料";
            case 10:
                return "穀物";            
           
        }
    }

}
