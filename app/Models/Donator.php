<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donator extends Model
{
    use HasFactory;

    public function donations(){
        return $this->hasMany(Donation::class,'donator_id','id');
    }
    public function preExam(){
        return $this->hasManyThrough(PreExam::class,Donation::class,'donator_id','id','id','pre_exam');
    }
}
