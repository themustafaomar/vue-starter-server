<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        $super_admin_role = Role::create(['name' => 'super-admin', 'guard_name' => 'sanctum']);
        $admin_role = Role::create(['name' => 'admin', 'guard_name' => 'sanctum']);
        $moderator_role = Role::create(['name' => 'moderator', 'guard_name' => 'sanctum']);
        $regular_role = Role::create(['name' => 'regular', 'guard_name' => 'sanctum']);

        // Create and assign permissions to roles
        $this->createPermissions($roles = $this->getPermissions());
        $this->assignPermissions($roles);

        // Create the super admin
        User::factory()->create([
            'name' => 'Mustafa Omar',
            'email' => 'themustafaomar@gmail.com',
        ])
        ->assignRole('super-admin');

        // Create the admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ])
        ->assignRole('admin');

        // Create the moderator
       User::factory()->create([
            'name' => 'Moderator',
            'email' => 'moderator@gmail.com',
        ])
        ->assignRole('moderator');

        // Let's create some regular users.
        User::factory(5)->create()->each->assignRole('regular');
    }

    /**
     * Get a list of roles and permissions
     * 
     * @return \Illuminate\Support\Collection
     */
    public function getPermissions()
    {
        return collect(require_once database_path('data/permissions.php'));
    }

    /**
     * Create a CRUD of given permissions
     * 
     * @param \Illuminate\Support\Collection $roles
     * @return void
     */
    public function createPermissions($roles)
    {
        $roles->collapse()->each(function ($permissions, $name) {
            $this->makeCrud($name)->each(fn ($permission) => Permission::create($permission));
        });
    }

    /**
     * Assign permissions to the corresponding roles
     * 
     * @param \Illuminate\Support\Collection $roles
     * @return void
     */
    public function assignPermissions($roles)
    {
        $roles->each(function ($permissions_group, $role) {
            $role = Role::whereName($role)->first();

            collect($permissions_group)->each(function ($value, $permission) use ($role) {
                $fn = fn ($prefix) => $role->givePermissionTo($prefix.' '.$permission);

                if ($value === '*') {
                    collect(['view', 'create', 'update', 'delete'])->each($fn);
                }

                if (is_array($value)) {
                    collect($value)->filter()->keys()->each($fn);
                }
            });
        });
    }

    /**
     * Create a group of permissions
     * 
     * @param string $group_name
     * @return \Illuminate\Support\Collection
     */
    protected function makeCrud($group_name)
    {
        // The group name inspired by:
        // https://github.com/spatie/laravel-permission/issues/1010#issuecomment-953719111 
        return collect(['view', 'create', 'update', 'delete'])
            ->map(fn ($prefix) => [
                'name' => $prefix.' '.$group_name,
                'group_name' => $group_name,
                'guard_name' => 'sanctum'
                // 'label_name' => $prefix,
            ]);
    }
}
