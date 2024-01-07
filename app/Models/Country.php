<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
   use HasFactory;
   public static function getCountry($string)
    {   
        $string =  '0' . $string;
        return self::where( 'Country', 'like', $string . '%')
                   ->orderBy('id', 'asc')
                   ->get();
    }
}
