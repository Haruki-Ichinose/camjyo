<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    public function parentChild()
  {
    return $this->hasMany(Child::class);
  }

  public static function getname_fromID($string)
    {   
        $parent = self::where('id', $string)->orderBy('id', 'asc')->first();
    
        return $parent ? $parent->parent : null;
    }
  
  public static function getdata_fromID($string)
  {   
      $parent = self::where('id', $string)->orderBy('id', 'asc')->first();
    
      return $parent;
  }
}
