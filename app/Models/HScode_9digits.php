<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HScode_9digits extends Model
{
    use HasFactory;

    public static function get9digit_TableContents($string)
    {   
        return self::where( 'HScode_4', '=', $string)
                   ->orderBy('HScode_5', 'asc')
                   ->get();
    }

    public static function get9digit_TableContents_fromID($string)
    {   
        return self::where( 'id', '=', $string)
                   ->orderBy('HScode_5', 'asc')
                   ->first();
    }
}
