<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Create roles
        $roleSuperAdmin = Role::create(['name' => 'admin', 'guard_name' => 'admin']);

        //  permission List as array
        $permissions = [
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    // Dashboard permission
                    'dashboard.view',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    // Role permission
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                ]
            ],
            [
                'group_name' => 'profile',
                'permissions' => [
                    // Profile permission
                    'profile.view',
                    'profile.edit',
                ]
            ],
        ];

        // Assaign Permission
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];

            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create([
                    'name' => $permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                    'guard_name' => 'admin'
                ]);

                $roleSuperAdmin->givePermissionTo($permission);
            }
        }
    }
}
