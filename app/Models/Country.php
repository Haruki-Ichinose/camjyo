<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
     // name, email, passwordカラムにデータの挿入を許可する
    protected $guarded = [
        'name',
    ];
}
