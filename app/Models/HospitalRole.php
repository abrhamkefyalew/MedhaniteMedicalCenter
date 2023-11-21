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



    /**
     *          HOSPITAL_ADMIN_ADMIN
     * can do everything BUT
     *      => he can NOT change his own ROLE (he can NOT increase or decrease his role)
     *           this is because => he may be locked out of his own account (if he downgrade his ROLE by mistake, he may not be able to login as HOSPITAL_ADMIN_ADMIN), 
     *                 this will affect the hospital as   
     *                     the hospital will not have a hospitalWorker with ROLE = HOSPITAL_ADMIN_ADMIN 
     *                         any hospital needs at least one HOSPITAL_ADMIN_ADMIN
     *                         to create a hospitalWorker with ROLE = HOSPITAL_ADMIN_ADMIN we need another HOSPITAL_ADMIN_ADMIN
     *                         so if we do not have HOSPITAL_ADMIN_ADMIN, we must update the database table manually to edit the hospitalWorker ROLE to make it = HOSPITAL_ADMIN_ADMIN
     * 
     *       SOLUTION for the ABOVE
     *              to change HOSPITAL_ADMIN_ADMIN role you need another hospitalWorker with HOSPITAL_ADMIN_ADMIN role, 
     *                  so one HOSPITAL_ADMIN_ADMIN can change another HOSPITAL_ADMIN_ADMIN role,
     *                  BUT HOSPITAL_ADMIN_ADMIN can not change his own role
     * 
     *       = > this way we can always have at least one hospitalWorker with Role = HOSPITAL_ADMIN_ADMIN  (which is necessary for the hospital to function)
     */
    public const HOSPITAL_ADMIN_ADMIN_ROLE = 'HOSPITAL_ADMIN_ADMIN'; 



    /** 
     *          HOSPITAL_ADMIN
     * can do everything BUT can NOT do the Following (the CAN and CAN NOT are in the following)
     *     => he can NOT change his own ROLE (he can NOT increase or decrease his role)
     * 
     *          a. he can NOT Store, can NOT create another hospitalWorker with ROLE = HOSPITAL_ADMIN_ADMIN - (can NOT create a hospitalWorker with role = HOSPITAL_ADMIN_ADMIN) 
     *                       // this is because => the HOSPITAL_ADMIN should NOT create another user with higher privileges (with ROLE = HOSPITAL_ADMIN_ADMIN) for his own self, that he was not given or deserve (it is Illegal)
     *                // he can ONLY Store or Create another hospitalWorker with ROLE = HOSPITAL_WORKER or HOSPITAL_ADMIN
     *          b. he can NOT Delete, can NOT Update a hospitalWorker with a ROLE = HOSPITAL_ADMIN_ADMIN & HOSPITAL_ADMIN
     *                // he can ONLY see (Show, Index) the HOSPITAL_ADMIN_ADMIN & HOSPITAL_ADMIN
     *                // BUT he can do anything to hospitalWorker with a ROLE = HOSPITAL_WORKER
     *
     *          c. he can NOT increase the Role of any hospitalWorker to = HOSPITAL_ADMIN_ADMIN 
     *          d. he can ONLY upgrade a hospitalWorker with a ROLE = HOSPITAL_WORKER to HOSPITAL_ADMIN,      but not vice versa
     *                // BUT he can NOT change (downgrade) another hospitalWorker with a ROLE = HOSPITAL_ADMIN to HOSPITAL_WORKER  
     * 
     *          e. he can do anything to hospitalWorker with a ROLE = HOSPITAL_WORKER       (can do any thing to only this Role = HOSPITAL_WORKER)
     * 
     *          f. he can NOT change his own ROLE (he can NOT increase or decrease his OWN Role)
     *                  he an NOT modify his OWN ROLE, he can NOT change his own ROLE to any Role 
     *                      // this is because          => (if he decrease his role: he may be locked out of his account)                => (if he increase his role: it is illegal)
     * */ 
    public const HOSPITAL_ADMIN_ROLE = 'HOSPITAL_ADMIN'; 

    

    /**
     *          HOSPITAL_WORKER
     * can ONLY see (for now)
     *      a. Doctor : -
     *         => can index, show
     *              can see (index, show) all information of doctor
     * 
     *      b. HospitalWorker - for another hospitalWorkers: -
     *         => can index, show
     *               - if you want to limit how much hospitalWorker info the HOSPITAL_WORKER can see, 
     *                       // create another additional hospitalWorker Resource for the hospitalWorker with ROLE = HOSPITAL_WORKER in resources 
     *                              Example: - HospitalWorkerForHospitalWorkerRoleResource.php
     * 
     *      c. HospitalWorker - HIS OWN : -he can see all info of his profile using show in HospitalWorkerController
     * 
     *      d. Hospital: - can only see (show) his own
     *      e. Speciality: -  => can index, show (only the one in his hospital),    
     *              can NOT add or remove Speciality
     *      f. Equipment: -  => can index, show (only the one in his hospital),  
     *              can NOT add or remove Equipment
     */
    public const HOSPITAL_WORKER_ROLE = 'HOSPITAL_WORKER';


    public const SYSTEM_HOSPITAL_ROLES = [self::HOSPITAL_ADMIN_ADMIN_ROLE, self::HOSPITAL_ADMIN_ROLE, self::HOSPITAL_WORKER_ROLE]; // abrham comment // please ask frezer or seifu or amen and add other system_hospital_roles if there are any
}
