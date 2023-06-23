<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\EloquentHasManyDeep\Eloquent\Relations\Traits\HasEagerLimit;

class Speciality extends Model
{
    use HasFactory, SoftDeletes, HasEagerLimit; 
    // HasEagerLimit is used for deep relations (like permission role) use it if you add speciality_type table (SpecialityType Model) and have speciality_type

   /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'speciality_name',
        'speciality_description',
    ];

    protected $table = 'specialities';

    // no specialityType and speciality relation yet

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class);
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }

    // no job postings in the hospitals yet

    public static function boot() {
        parent::boot();

        self::deleting(function (Speciality $speciality) {
            HospitalSpeciality::where('speciality_id', $speciality->id)->delete();
        });

        self::restored(function (Speciality $speciality){
            HospitalSpeciality::where('speciality_id', $speciality->id)->restore();
        }); 
    }
}
