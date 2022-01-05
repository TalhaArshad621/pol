<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = ['name','address','gender','age','contact_num','blood_type'];

    public function request()
    {
        return $this->belongsTo('App\Models\Request', 'patient_id', 'id');
    }
}
