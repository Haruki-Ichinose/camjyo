<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imformation extends Model
{
    use HasFactory;

    public function Child()
  {
    return $this->belongsTo(Child::class);
  }

}
