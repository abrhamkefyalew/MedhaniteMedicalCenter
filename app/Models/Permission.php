<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use SoftDeletes, HasRelationships;

    public $table = 'permissions';

    protected $fillable = [
        'title',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function admins()
    {
        return $this->hasManyDeepFromRelations($this->roles(), (new Role())->admins());
    }

    // no Permission Groups Yet

    public const INDEX_ROLE = 'INDEX_ROLE';

    public const SHOW_ROLE = 'SHOW_ROLE';

    public const CREATE_ROLE = 'CREATE_ROLE';

    public const EDIT_ROLE = 'EDIT_ROLE';

    public const DELETE_ROLE = 'DELETE_ROLE';

    public const RESTORE_ROLE = 'RESTORE_ROLE';

    public const INDEX_PERMISSION = 'INDEX_PERMISSION';

    public const SHOW_PERMISSION = 'SHOW_PERMISSION';

    public const INDEX_PERMISSION_ROLE = 'INDEX_PERMISSION_ROLE';

    public const SHOW_PERMISSION_ROLE = 'SHOW_PERMISSION_ROLE';

    public const CREATE_PERMISSION_ROLE = 'CREATE_PERMISSION_ROLE';

    public const EDIT_PERMISSION_ROLE = 'EDIT_PERMISSION_ROLE';

    public const DELETE_PERMISSION_ROLE = 'DELETE_PERMISSION_ROLE';

    public const RESTORE_PERMISSION_ROLE = 'RESTORE_PERMISSION_ROLE';

    public const INDEX_HOSPITAL = 'INDEX_TALENT';

    public const SHOW_HOSPITAL = 'SHOW_TALENT';

    public const CREATE_HOSPITAL = 'CREATE_TALENT';

    public const EDIT_HOSPITAL = 'EDIT_TALENT';

    public const DELETE_HOSPITAL = 'DELETE_TALENT';

    public const RESTORE_HOSPITAL = 'RESTORE_TALENT';

}
