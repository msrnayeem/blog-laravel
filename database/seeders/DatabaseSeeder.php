<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);

        $bloggerRole = Role::create(['name' => 'blogger']);
        $adminRole = Role::create(['name' => 'admin']);

        $createPostPermission = Permission::create(['name' => 'create post']);
        $editPostPermission = Permission::create(['name' => 'edit post']);
        $deletePostPermission = Permission::create(['name' => 'delete post']);
        $manageUserPermission = Permission::create(['name' => 'manage user']);

        $bloggerRole->givePermissionTo($createPostPermission);
        $bloggerRole->givePermissionTo($editPostPermission);
        $bloggerRole->givePermissionTo($deletePostPermission);

        $adminRole->givePermissionTo($manageUserPermission);
        $adminRole->givePermissionTo($editPostPermission);
        $adminRole->givePermissionTo($deletePostPermission);


        $admin->assignRole($adminRole);
        $user->assignRole($bloggerRole);


    }
}
