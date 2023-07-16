<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentType extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'equipment_type_name',
        'equipment_type_description'
    ];

    protected $table = 'equipment_types';
    

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }


    // May be do the boot function here when equipmentType is deleted

}
