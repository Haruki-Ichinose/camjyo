<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public static function get_from_IDs($countries_id,$h_scode_9digits_id){
        $data = self::where('countries_id',$countries_id)->where('h_scode_9digits_id',$h_scode_9digits_id)->get();
        return $data;
    }
}
