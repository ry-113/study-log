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
        $adminRole = Role::findByName('admin');
        $permissions = Permission::all();
        $adminRole->givePermissionTo($permissions);

        $instructorRole = Role::findByName('instructor');
        $instructorRole->givePermissionTo([
            'view-users',
            'view-lessons',
            'create-lessons',
            'edit-lessons',
        ]);

        $studentRole = Role::findByName('student');
        $studentRole->givePermissionTo([
            'view-lessons',
        ]);

        User::created(function (User $user) {
            $user->assignRole('student');
        });

        $user = User::find(1);
        if($user) {
            $user->assignRole('admin');
        }
    }
}
