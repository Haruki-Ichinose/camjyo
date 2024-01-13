<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    public static function getname_fromID($string)
    {   
        $child = self::where('id', $string)->orderBy('id', 'asc')->first();
    
        return $child ? $child->child : null;
    }

    public static function getdata_fromID($string)
    {   
        $child = self::where('id', $string)->orderBy('id', 'asc')->first();
    
        return $child;
    }
}