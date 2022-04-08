<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class PermissionGatePolicy {

    public function setGateAndPolicy()
    {
        $this->defineGateUser();
        $this->defineGateRole();
        $this->defineGatePermission();
        $this->defineCustomGatePermission();
    }

    public function defineGateUser()
    {
        Gate::define('list-user', 'App\Policies\UserPolicy@view');
        Gate::define('create-user', 'App\Policies\UserPolicy@create');
        Gate::define('update-user', 'App\Policies\UserPolicy@update');
        Gate::define('delete-user', 'App\Policies\UserPolicy@delete');
    }

    public function defineGateRole()
    {
        Gate::define('list-role', 'App\Policies\RolePolicy@view');
        Gate::define('create-role', 'App\Policies\RolePolicy@create');
        Gate::define('update-role', 'App\Policies\RolePolicy@update');
        Gate::define('delete-role', 'App\Policies\RolePolicy@delete');
    }

    public function defineGatePermission()
    {
        Gate::define('list-permission', 'App\Policies\PermissionPolicy@view');
        Gate::define('create-permission', 'App\Policies\PermissionPolicy@create');
        Gate::define('update-permission', 'App\Policies\PermissionPolicy@update');
        Gate::define('delete-permission', 'App\Policies\PermissionPolicy@delete');
    }

    public function defineCustomGatePermission(){
        $ability = ['view','create','update','delete'];
            foreach($ability as $item){
                Gate::define($item,'App\Policies\GeneralPolicy@'.$item);
            }
    }
}
