<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRequest extends Model
{
    use HasFactory;
    protected $fillable = ['amount','status','last_date','patient_id'];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id', 'id');
    }
}
