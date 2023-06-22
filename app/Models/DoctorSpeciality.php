<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DoctorSpeciality extends Pivot
{
    //
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
