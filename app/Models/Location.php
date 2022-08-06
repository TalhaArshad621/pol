<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Location extends Model
{
    use HasFactory;

    public function locationCode(){
        return $this->belongsTo(LocationCode::class,'lc','id');
    }
}
