<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        Role::firstOrCreate([
            'name' => 'instructor',
            'guard_name' => 'web'
        ]);
        Role::firstOrCreate([
            'name' => 'student',
            'guard_name' => 'web'
        ]);

        Permission::firstOrCreate([
            'name' => 'view-users',
            'guard_name' => 'web'
        ]);
        Permission::firstOrCreate([
            'name' => 'view-lessons',
            'guard_name' => 'web'
        ]);
    
    

        $adminRole = Role::findByName('admin');
        $permissions = Permission::all();
        $adminRole->givePermissionTo($permissions);

        $instructorRole = Role::findByName('instructor');
        $instructorRole->givePermissionTo([
            'view-users',
            'view-lessons',
        ]);

        $studentRole = Role::findByName('student');
        $studentRole->givePermissionTo([
            'view-lessons',
        ]);

        User::created(function (User $user) {
            $user->assignRole('student');
        });

        $user = User::where('email', 'nvdw23029@nvrcd.ac.jp')->first();
        if($user) {
            $user->assignRole('admin');
        }
    }
}
