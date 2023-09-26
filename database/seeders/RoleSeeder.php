<?php

namespace Database\Seeders;

use App\Models\User;
use Common\ValueObject\PermissionValueObject;
use Common\ValueObject\RoleValueObject;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = RoleValueObject::available();

        $permissions = PermissionValueObject::available();

        foreach ($permissions as $permission) {
            Permission::firstOrNew(['name' => $permission, 'guard_name' => 'web'])->save();
        }

        foreach ($roles as $role) {
            $roleModel = Role::firstOrNew(['name' => $role, 'guard_name' => 'web']);
            $roleModel->save();

            if ($role === RoleValueObject::admin()->getValue()) {
                $permission = Permission::findByName(PermissionValueObject::canDeletePost()->getValue());

                $roleModel->givePermissionTo($permission);
                $permission->assignRole($roleModel);
            }
        }
    }
}
