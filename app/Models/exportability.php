<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exportability extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public static function getdatafrom_Country_and_HScode($country_id,$HScode_id)
    {   
        $data = self::where('countries_id', $country_id)->where('h_scode_9digits_id', $HScode_id)->orderby('updated_at','desc')->first();
    
        return $data;
    }
}
