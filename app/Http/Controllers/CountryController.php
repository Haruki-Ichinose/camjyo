<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class Country extends Model
{
    use HasFactory;

    public static function getCountry($string)
    {
        $string = '0' . $string;
        return self::where('Country', 'like', $string . '%')
            ->orderBy('id', 'asc')
            ->get();
    }
}