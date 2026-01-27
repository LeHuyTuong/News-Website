<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Reset cached
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Tạo Quyền (Permissions) - Dùng firstOrCreate để tránh lỗi trùng lặp
        Permission::firstOrCreate(['name' => 'view posts']);
        Permission::firstOrCreate(['name' => 'create posts']);
        Permission::firstOrCreate(['name' => 'edit posts']);
        Permission::firstOrCreate(['name' => 'delete posts']);
        Permission::firstOrCreate(['name' => 'publish posts']);

        Permission::firstOrCreate(['name' => 'manage categories']);

        // 3. Tạo Roles & Gán quyền
        
        // WRITER
        $role = Role::firstOrCreate(['name' => 'writer']);
        $role->syncPermissions(['view posts', 'create posts', 'edit posts']); // syncPermissions an toàn hơn givePermissionTo khi chạy lại

        // EDITOR
        $role = Role::firstOrCreate(['name' => 'editor']);
        $role->syncPermissions(['view posts', 'create posts', 'edit posts', 'delete posts', 'publish posts', 'manage categories']);

        // SUPER-ADMIN
        $role = Role::firstOrCreate(['name' => 'super-admin']);
        $role->syncPermissions(Permission::all());
    }
}
