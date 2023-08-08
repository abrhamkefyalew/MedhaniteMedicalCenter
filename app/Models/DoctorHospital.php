<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorHospital extends Pivot
{
    //
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'hospital_id',
        'doctor_id',
    ];

    protected $table = 'doctor_hospital';

    // is not used yet
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    // is not used yet
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

}
