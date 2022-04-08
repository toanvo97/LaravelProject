<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    //
    protected $table = 'user_role';

    protected $fillable = ['user_id','auth_id'];

    protected $primaryKey = ['user_id','auth_id'];
}
