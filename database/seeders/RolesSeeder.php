<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Entities\Role;
use Modules\User\Entities\User;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::query()->create(['name' => 'admin', 'title' => 'مدیر']);
        $roleMember = Role::query()->create(['name' => 'member', 'title' => 'کاربر']);
        $roleTester = Role::query()->create(['name' => 'seller', 'title' => 'فروشنده']);

        $roleAdmin->syncPermissions(Permission::all());

        $admin = User::query()->create([

            'first_name'               => 'امیرعلی',
            'last_name'               => 'باقری',
            'email'              => 'bagheriamirali2000@gmail.com',
            'password'           => 'Amirali@5080',
            'status'             => 1,
            'mobile'             => '09129286632',
            'remember_token'     => Str::random(10),
            'created_at'         => now(),
            'updated_at'         => now(),
            'mobile_verified_at' => now(),
        ])->assignRole([
            'admin',
            'member',
            'seller',
        ]);


        /*  User::create([

              'name'               => 'Test',
              // 'first_name' => 'امیرعلی',
              // 'last_name' => 'باقری',
              'email'              => 'test@test.com',
              'password'           => '1234567890',
              'status'             => 1,
              'mobile'             => '09000000000',
              'remember_token'     => Str::random(10),
              'created_at'         => now(),
              'updated_at'         => now(),
              'mobile_verified_at' => now(),
          ])->assignRole([
              'member',
          ]);*/
        // User::create([
        //
        //     'name'               => 'محمد باقری',
        //     // 'first_name' => 'امیرعلی',
        //     // 'last_name' => 'باقری',
        //     'email'              => 'irancableman@gmail.com',
        //     'password'           => '6632pars',
        //     'status'             => 1,
        //     'mobile'             => '09122416632',
        //     'remember_token'     => Str::random(10),
        //     'created_at'         => now(),
        //     'updated_at'         => now(),
        //     'mobile_verified_at' => now(),
        // ])->assignRole([
        //     'member',
        // ]);
        //
        // Auth::login($admin);
    }
}
