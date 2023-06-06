<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class HospitalSpeciality extends Pivot
{
    //
    protected $fillable = [
        'hospital_id',
        'speciality_id',
    ];

    protected $table = 'hospital_speciality';

    // is not used yet
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    // is not used yet
    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }
}
