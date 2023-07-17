<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Hospital extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hospital_name',
        'hospital_description',
        'hospital_email',
        'hospital_phone_number',
        'hospital_working_hours',
        'hospital_is_active',
        'hospital_is_approved',
    ];

    protected $table = 'hospitals';

    protected $casts = [
        'hospital_working_hours' => 'array', // USED
        // 'hospital_working_hours' => 'json', // this works also
    ];

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function hospitalWorkers()
    {
        return $this->hasMany(HospitalWorker::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class);
    }

    public function equipments()
    {
        return $this->belongsToMany(Equipment::class);
    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('optimized')
            ->width(1000)
            ->height(1000);

        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150);
    }

    // Declare Constants
    
    // Hospital Image Types should be Constants, // ask seife and others for the types of images for the hospital
    public const PROFILE_PICTURE_HOSPITAL_PICTURE = 'PROFILE_PICTURE';
    public const NIGD_FIKAD_HOSPITAL_PICTURE = 'NIGD_FIKAD';
    public const TIN_NUMBER_HOSPITAL_PICTURE = 'TIN_NUMBER';
    public const TEINA_TIBEKA_HOSPITAL_PICTURE = 'TEINA_TIBEKA';
}
