<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentHospital extends Pivot
{
    use HasFactory, SoftDeletes;
    
    

    protected $table = 'equipment_hospital';
}
