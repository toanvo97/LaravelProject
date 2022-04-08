<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Model\Role;
use App\Model\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // User::truncate();
        // UserRole::truncate();
        // $superAdmin = Role::where('name','superAdmin')->first();
        // $admin      = Role::where('name','admin')->first();
        // $client     = Role::where('name','client')->first();

        // $spadmin    = User::create([
        //     'name'=>'spadmin2',
        //     'email'=>'sp1_admin@gmail.com',
        //     'password'=>bcrypt('123456789'),
        // ]);

        // $ad         = User::create([
        //     'name'=>'subAdmin2',
        //     'email'=>'sub1_admin@gmail.com',
        //     'password'=>bcrypt('123456789'),
        // ]);

        // $cl         = User::create([
        //     'name'=>'client1',
        //     'email'=>'sub1_client@gmail.com',
        //     'password'=>bcrypt('123456789'),
        // ]);

        // $spadmin->roles()->attach($superAdmin);
        // $ad->roles()->attach($admin);
        // $cl->roles()->attach($client);



        // DB::table('permission')->insert(
        //     ['id' => 1, 'name' => 'read'],
        //     ['id' => 2, 'name' => 'create'],
        //     ['id' => 3, 'name' => 'update'],
        //     ['id' => 4, 'name' => 'delete'],
        //     ['id' => 5, 'name' => 'full'],
        // );

        // DB::table('user_role')->insert(
        //     // [
        //     //     'user_id' => 1,
        //     //     'auth_id' => 1,
        //     // ],
        //     // [
        //     //     'user_id' => 9,
        //     //     'auth_id' => 1,
        //     // ],
        //     // [
        //     //     'user_id' => 10,
        //     //     'auth_id' => 1,
        //     // ],
        //     [
        //         'user_id' => 11,
        //         'auth_id' => 1,
        //     ]
        // );
        //DB::table('permission_role')->insert(
        //     [
        //     'permission_id'=>1,
        //     'role_id'=>1,
        // ],
        // [
        //     'permission_id'=>2,
        //     'role_id'=>1,
        // ],
        // [
        //     'permission_id'=>3,
        //     'role_id'=>1,
        // ],
        // [
        //     'permission_id'=>4,
        //     'role_id'=>1,
        // ],
        // [
        //     'permission_id'=>5,
        //     'role_id'=>1,
        // ],
   // );


    }
}
