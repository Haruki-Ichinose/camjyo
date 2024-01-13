<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grandchild extends Model
{
    use HasFactory;

    public static function getname_fromID($string)
    {   
        $grandchild = self::where('id', $string)->orderBy('id', 'asc')->first();
    
        return $grandchild ? $grandchild->grandchild : null;
    }

    public static function getdata_fromID($string)
    {   
        $grandchild = self::where('id', $string)->orderBy('id', 'asc')->first();
    
        return $grandchild;
    }
}
