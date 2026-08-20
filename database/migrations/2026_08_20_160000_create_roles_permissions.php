<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    public function up(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $guard = config('auth.defaults.guard', 'web');

        $empOrtea = Permission::findOrCreate('EmpOrtea', $guard);
        $empCoco = Permission::findOrCreate('EmpCocoSublime', $guard);

        $super = Role::findOrCreate('SuperAdmin', $guard);
        $ortea = Role::findOrCreate('Ortea', $guard);
        $coco = Role::findOrCreate('CocoSublime', $guard);

        $ortea->givePermissionTo($empOrtea);
        $coco->givePermissionTo($empCoco);
        $super->givePermissionTo([$empOrtea, $empCoco]);

        $user = User::firstOrCreate(
            ['email' => 'carlos@gmail.com'],
            ['name' => 'Carlos', 'password' => bcrypt('Carlos1234')]
        );
        $user->assignRole($super);
    }

    public function down(): void
    {
        $guard = config('auth.defaults.guard', 'web');

        $user = User::where('email', 'carlos@gmail.com')->first();
        if ($user) {
            $user->removeRole('SuperAdmin');
        }

        foreach (['SuperAdmin', 'Ortea', 'CocoSublime'] as $roleName) {
            $role = Role::where('name', $roleName)->where('guard_name', $guard)->first();
            $role?->delete();
        }

        foreach (['EmpOrtea', 'EmpCocoSublime'] as $permissionName) {
            $permission = Permission::where('name', $permissionName)->where('guard_name', $guard)->first();
            $permission?->delete();
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
};