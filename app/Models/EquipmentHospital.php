<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentHospital extends Pivot
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'hospital_id',
        'equipment_id',
    ];

    protected $table = 'equipment_hospital';

    // is not used yet
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    // is not used yet
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

}
