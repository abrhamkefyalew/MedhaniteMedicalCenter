<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class HospitalRoleHospitalWorker extends Pivot
{
    //
    protected $fillable = [
        'hospital_role_id',
        'hospital_worker_id',
    ];

    protected $table = 'hospital_role_hospital_worker';

    // is not used yet
    public function hospitalWorker()
    {
        return $this->belongsTo(HospitalWorker::class);
    }

    // is not used yet
    public function hospitalRole()
    {
        return $this->belongsTo(HospitalRole::class);
    }
}
