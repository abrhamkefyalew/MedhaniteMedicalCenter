<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorSpeciality extends Pivot
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'doctor_id',
        'speciality_id',
    ];

    protected $table = 'doctor_speciality';

    // is not used yet
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // is not used yet
    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }
}
