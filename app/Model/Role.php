<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $guarded = [];
    protected $table = 'roles';

    protected $fillable = [
        'name'
    ];

    protected $primaryKey = 'id';

    /**
     * a user belong to many roles, a role has many users
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasAnyPermissions($permissions)
    {
        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                if ($this->hasPermission($permission)) {
                    return true;
                }
            }
        } else {
            if ($this->hasPermission($permissions)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        if ($this->permissions()->where('name', $permission)->first()) {
            return true;
        }
        return false;
    }
}
