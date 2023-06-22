<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Notifications\Api\V1\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HospitalWorker extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hospital_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'job_title',
        'is_active',
        'is_approved',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'hospital_workers';

    public function setPasswordAttribute($password)
    {
        if ($password) {
            $this->attributes['password'] = app('hash')->needsRehash($password) ? Hash::make($password) : $password;
        }
    }

    public function getNameAttribute()
    {
        return $this->getFullNameAttribute();
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function hospitalRoles()
    {
        return $this->belongsToMany(HospitalRole::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $url = 'https://medhanite.com/hospital-workers/reset-password/?token='.$token; // modify this url // depending on your route

         $this->notify(new ResetPasswordNotification($url));
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

    // constants
    public const PROFILE_PICTURE_HOSPITAL_WORKER_PICTURE = 'PROFILE_PICTURE';
}
