<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Model\Role;
use App\Traits\HasPermissions;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * a role belong to many users, a user has many roles
     */
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasAnyRoles($roles){

 		if(is_array($roles)){
 			foreach($roles as $role){
 				if($this->hasRole($role)){
 					return true;
 				}
 			}
 		}else{
 			if($this->hasRole($roles)){
 				return true;
 			}
 		}
 		return false;
 	}
 	public function hasRole($role){
 		if($this->roles()->where('name',$role)->first()){
 			return true;
 		}
 		return false;
 	}

    //  public function hasPermission($permission = null)
    // {
    //     if (is_null($permission)) {
    //         return $this->getPermissions()->count();
    //     }

    //     if (is_string($permission)) {
    //         return $this->getPermissions()->contains('name', $permission);
    //     }

    //     return false;
    // }

    // private function getPermissions()
    // {
    //     $role = $this->roles->first();
    //     if ($role) {
    //         if (! $role->relationLoaded('permissions')) {
    //             $this->roles->load('permissions');
    //         }

    //         $this->permissionList = $this->roles->pluck('permissions')->flatten();
    //     }

    //     return $this->permissionList ?? collect();
    // }

    public function checkPermissionAccess($pemissionCheck)
    {
        // use login co quyen add, sua danh muc va xem menu
       // B1 lay duoc tat ca cac quyen cua user dang login he thong
        // B2 So sanh gia tri dua vao cua router hien tai xem co ton tai trong cac quyen ma minh lay dc hay khong
        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            $permissions = $role->permissions;
            if ($permissions->contains('keycode', $pemissionCheck)) {
                return true;
            }
        }
        return false;
    }
}
