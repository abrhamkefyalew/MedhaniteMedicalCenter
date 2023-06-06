<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AdminRole extends Pivot
{
    //
    protected $fillable = [
        'role_id',
        'admin_id',
    ];

    protected $table = 'admin_role';

    // is not used yet
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    // is not used yet
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
