<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\EloquentHasManyDeep\Eloquent\Relations\Traits\HasEagerLimit;

class Equipment extends Model
{
    use HasFactory, SoftDeletes, HasEagerLimit; 
    // HasEagerLimit is used for deep relations (like permission role) use it if you add equipment_types table (EquipmentType Model) and have equipment_type

   /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'equipment_type_id',
        'equipment_name',
        'equipment_description',
    ];

    protected $table = 'equipment';



    // equipmentType and equipment relation
    public function equipmentType()
    {
        return $this->belongsTo(EquipmentType::class);
    }


    // equipment with Hospital relation
    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class);
    }

    // do the boot function here when equipment is deleted
    public static function boot()
    {
        parent::boot();

        self::deleting(function (Equipment $equipment) {
            EquipmentHospital::where('equipment_id', $equipment->id)->delete();
        });

        self::restored(function (Equipment $equipment) {
            EquipmentHospital::where('equipment_id', $equipment->id)->restore();
        });
    }

}
