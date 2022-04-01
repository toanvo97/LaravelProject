<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    //
    protected $table='authorities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

}
