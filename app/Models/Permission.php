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




    public const INDEX_ADMIN = 'INDEX_ADMIN';

    public const SHOW_ADMIN = 'SHOW_ADMIN';

    public const CREATE_ADMIN = 'CREATE_ADMIN';

    public const EDIT_ADMIN = 'EDIT_ADMIN';

    public const DELETE_ADMIN = 'DELETE_ADMIN';

    public const RESTORE_ADMIN = 'RESTORE_ADMIN';


    


    public const INDEX_ROLE = 'INDEX_ROLE';

    public const SHOW_ROLE = 'SHOW_ROLE';

    public const CREATE_ROLE = 'CREATE_ROLE';

    public const EDIT_ROLE = 'EDIT_ROLE';

    public const DELETE_ROLE = 'DELETE_ROLE';

    public const RESTORE_ROLE = 'RESTORE_ROLE';


    public const INDEX_PERMISSION = 'INDEX_PERMISSION';

    public const SHOW_PERMISSION = 'SHOW_PERMISSION';
    

    public const SYNC_PERMISSION_ROLE = 'SYNC_PERMISSION_ROLE';

    public const INDEX_PERMISSION_ROLE = 'INDEX_PERMISSION_ROLE';

    public const SHOW_PERMISSION_ROLE = 'SHOW_PERMISSION_ROLE';

    public const CREATE_PERMISSION_ROLE = 'CREATE_PERMISSION_ROLE';

    public const EDIT_PERMISSION_ROLE = 'EDIT_PERMISSION_ROLE';

    public const DELETE_PERMISSION_ROLE = 'DELETE_PERMISSION_ROLE';

    public const RESTORE_PERMISSION_ROLE = 'RESTORE_PERMISSION_ROLE';


    public const SYNC_ROLE_ADMIN = 'SYNC_ROLE_ADMIN';
    
    public const INDEX_ROLE_ADMIN = 'INDEX_ROLE_ADMIN';

    public const SHOW_ROLE_ADMIN = 'SHOW_ROLE_ADMIN';

    public const CREATE_ROLE_ADMIN = 'CREATE_ROLE_ADMIN';

    public const EDIT_ROLE_ADMIN = 'EDIT_ROLE_ADMIN';

    public const DELETE_ROLE_ADMIN = 'DELETE_ROLE_ADMIN';

    public const RESTORE_ROLE_ADMIN = 'DELETE_ROLE_ADMIN';



    

    public const INDEX_HOSPITAL = 'INDEX_HOSPITAL';

    public const SHOW_HOSPITAL = 'SHOW_HOSPITAL';

    public const CREATE_HOSPITAL = 'CREATE_HOSPITAL';

    public const EDIT_HOSPITAL = 'EDIT_HOSPITAL';

    public const DELETE_HOSPITAL = 'DELETE_HOSPITAL';

    public const RESTORE_HOSPITAL = 'RESTORE_HOSPITAL';





    public const INDEX_HOSPITAL_STAFF = 'INDEX_HOSPITAL_STAFF'; // These are Hospital Workers   // the hospital_admin is one or some of the hospital_staff if he has the role hospital_admin_admin

    public const SHOW_HOSPITAL_STAFF = 'SHOW_HOSPITAL_STAFF';

    public const CREATE_HOSPITAL_STAFF = 'CREATE_HOSPITAL_STAFF';

    public const EDIT_HOSPITAL_STAFF = 'EDIT_HOSPITAL_STAFF';

    public const DELETE_HOSPITAL_STAFF = 'DELETE_HOSPITAL_STAFF';

    public const RESTORE_HOSPITAL_STAFF = 'RESTORE_HOSPITAL_STAFF';


    

    
    public const INDEX_DOCTOR = 'INDEX_DOCTOR';

    public const SHOW_DOCTOR = 'SHOW_DOCTOR';

    public const CREATE_DOCTOR = 'CREATE_DOCTOR';

    public const EDIT_DOCTOR = 'EDIT_DOCTOR';

    public const DELETE_DOCTOR = 'DELETE_DOCTOR';

    public const RESTORE_DOCTOR = 'RESTORE_DOCTOR';





    public const INDEX_HOSPITAL_ROLE = 'INDEX_HOSPITAL_ROLE';

    public const SHOW_HOSPITAL_ROLE = 'SHOW_HOSPITAL_ROLE';

    public const CREATE_HOSPITAL_ROLE = 'CREATE_HOSPITAL_ROLE';

    public const EDIT_HOSPITAL_ROLE = 'EDIT_HOSPITAL_ROLE';

    public const DELETE_HOSPITAL_ROLE = 'DELETE_HOSPITAL_ROLE';

    public const RESTORE_HOSPITAL_ROLE = 'RESTORE_HOSPITAL_ROLE';


    public const SYNC_HOSPITAL_STAFF_HOSPITAL_ROLE = 'SYNC_HOSPITAL_STAFF_HOSPITAL_ROLE';

    public const INDEX_HOSPITAL_STAFF_HOSPITAL_ROLE = 'INDEX_HOSPITAL_STAFF_HOSPITAL_ROLE';

    public const SHOW_HOSPITAL_STAFF_HOSPITAL_ROLE = 'SHOW_HOSPITAL_STAFF_HOSPITAL_ROLE';

    public const CREATE_HOSPITAL_STAFF_HOSPITAL_ROLE = 'CREATE_HOSPITAL_STAFF_HOSPITAL_ROLE';

    public const EDIT_HOSPITAL_STAFF_HOSPITAL_ROLE = 'EDIT_HOSPITAL_STAFF_HOSPITAL_ROLE';

    public const DELETE_HOSPITAL_STAFF_HOSPITAL_ROLE = 'DELETE_HOSPITAL_STAFF_HOSPITAL_ROLE';

    public const RESTORE_HOSPITAL_STAFF_HOSPITAL_ROLE = 'RESTORE_HOSPITAL_STAFF_HOSPITAL_ROLE';





    public const SYNC_HOSPITAL_DOCTOR = 'SYNC_HOSPITAL_DOCTOR';

    public const INDEX_HOSPITAL_DOCTOR = 'INDEX_HOSPITAL_DOCTOR';

    public const SHOW_HOSPITAL_DOCTOR = 'SHOW_HOSPITAL_DOCTOR';

    public const CREATE_HOSPITAL_DOCTOR = 'CREATE_HOSPITAL_DOCTOR';

    public const EDIT_HOSPITAL_DOCTOR = 'EDIT_HOSPITAL_DOCTOR';

    public const DELETE_HOSPITAL_DOCTOR = 'DELETE_HOSPITAL_DOCTOR';

    public const RESTORE_HOSPITAL_DOCTOR = 'RESTORE_HOSPITAL_DOCTOR';





    public const INDEX_SPECIALITY = 'INDEX_SPECIALITY';

    public const SHOW_SPECIALITY = 'SHOW_SPECIALITY';

    public const CREATE_SPECIALITY = 'CREATE_SPECIALITY';

    public const EDIT_SPECIALITY = 'EDIT_SPECIALITY';

    public const DELETE_SPECIALITY = 'DELETE_SPECIALITY';

    public const RESTORE_SPECIALITY = 'RESTORE_SPECIALITY';
    

    public const SYNC_HOSPITAL_SPECIALITY = 'SYNC_HOSPITAL_SPECIALITY';

    public const INDEX_HOSPITAL_SPECIALITY = 'INDEX_HOSPITAL_SPECIALITY';

    public const SHOW_HOSPITAL_SPECIALITY = 'SHOW_HOSPITAL_SPECIALITY';

    public const CREATE_HOSPITAL_SPECIALITY = 'CREATE_HOSPITAL_SPECIALITY';

    public const EDIT_HOSPITAL_SPECIALITY = 'EDIT_HOSPITAL_SPECIALITY';

    public const DELETE_HOSPITAL_SPECIALITY = 'DELETE_HOSPITAL_SPECIALITY';

    public const RESTORE_HOSPITAL_SPECIALITY = 'RESTORE_HOSPITAL_SPECIALITY';


    public const SYNC_DOCTOR_SPECIALITY = 'SYNC_DOCTOR_SPECIALITY';

    public const INDEX_DOCTOR_SPECIALITY = 'INDEX_DOCTOR_SPECIALITY';

    public const SHOW_DOCTOR_SPECIALITY = 'SHOW_DOCTOR_SPECIALITY';

    public const CREATE_DOCTOR_SPECIALITY = 'CREATE_DOCTOR_SPECIALITY';

    public const EDIT_DOCTOR_SPECIALITY = 'EDIT_DOCTOR_SPECIALITY';

    public const DELETE_DOCTOR_SPECIALITY = 'DELETE_DOCTOR_SPECIALITY';

    public const RESTORE_DOCTOR_SPECIALITY = 'RESTORE_DOCTOR_SPECIALITY';


    


    public const INDEX_EQUIPMENT_TYPE = 'INDEX_EQUIPMENT_TYPE';

    public const SHOW_EQUIPMENT_TYPE = 'SHOW_EQUIPMENT_TYPE';

    public const CREATE_EQUIPMENT_TYPE = 'CREATE_EQUIPMENT_TYPE';

    public const EDIT_EQUIPMENT_TYPE = 'EDIT_EQUIPMENT_TYPE';

    public const DELETE_EQUIPMENT_TYPE = 'DELETE_EQUIPMENT_TYPE';

    public const RESTORE_EQUIPMENT_TYPE = 'RESTORE_EQUIPMENT_TYPE';





    public const INDEX_EQUIPMENT = 'INDEX_EQUIPMENT';

    public const SHOW_EQUIPMENT = 'SHOW_EQUIPMENT';

    public const CREATE_EQUIPMENT = 'CREATE_EQUIPMENT';

    public const EDIT_EQUIPMENT = 'EDIT_EQUIPMENT';

    public const DELETE_EQUIPMENT = 'DELETE_EQUIPMENT';

    public const RESTORE_EQUIPMENT = 'RESTORE_EQUIPMENT';
    

    public const SYNC_HOSPITAL_EQUIPMENT = 'SYNC_HOSPITAL_EQUIPMENT';
    
    public const INDEX_HOSPITAL_EQUIPMENT = 'INDEX_HOSPITAL_EQUIPMENT';

    public const SHOW_HOSPITAL_EQUIPMENT = 'SHOW_HOSPITAL_EQUIPMENT';

    public const CREATE_HOSPITAL_EQUIPMENT = 'CREATE_HOSPITAL_EQUIPMENT';

    public const EDIT_HOSPITAL_EQUIPMENT = 'EDIT_HOSPITAL_EQUIPMENT';

    public const DELETE_HOSPITAL_EQUIPMENT = 'DELETE_HOSPITAL_EQUIPMENT';

    public const RESTORE_HOSPITAL_EQUIPMENT = 'RESTORE_HOSPITAL_EQUIPMENT';

}
