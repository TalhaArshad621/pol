<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    public function preExam() {
        return $this->hasOne(PreExam::class,'id','pre_exam');
    }
    public function locations() {
        return $this->belongsTo(Location::class,'location_id','id');
    }

}
