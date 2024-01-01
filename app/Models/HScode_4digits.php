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

}
