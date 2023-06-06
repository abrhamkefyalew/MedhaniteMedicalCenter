<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospitalRole extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'hospital_roles';

    protected $fillable = [
        'hospital_role_title',
    ];

    public function hospitalWorkers()
    {
        return $this->belongsToMany(HospitalWorker::class)
        // ->whereNull('hospital_role_hospital_worker.deleted_at')
        ->withTimeStamps()
        ->withPivot(['expire_at', 'deleted_at']);
    }

    public function hospitalWorkersWithTrashed()
    {
        return $this->belongsToMany(HospitalWorker::class)
        ->withTimeStamps()
        ->withPivot(['expire_at', 'deleted_at']);
    }


    // no permissions Yet

    // no Permission Groups Yet

    

    public static function boot()
    {
        parent::boot();

        // if HospitalRole is deleted (soft deleted) , then, the corresponding data in the (Pivot table) HospitalRoleHospitalWorker Should be deleted (soft deleted) also
        self::deleting(function (HospitalRole $hospitalRole) {
            HospitalRoleHospitalWorker::where('hospital_role_id', $hospitalRole->id)->delete();
        });

        // if HospitalRole is restored, then, the deleted (soft deleted) corresponding data in the (Pivot table) HospitalRoleHospitalWorker Should be restored (restored) also
        self::restored(function (HospitalRole $hospitalRole) {
            HospitalRoleHospitalWorker::where('hospital_role_id', $hospitalRole->id)->restore();
        });
    }



    public const HOSPITAL_ADMIN_ROLE = 'HOSPITAL_ADMIN'; // can do everything


    public const SYSTEM_HOSPITAL_ROLES = [self::HOSPITAL_ADMIN_ROLE]; // abrham comment // please ask frezer or seifu or amen and add other system_hospital_roles if there are any
}
