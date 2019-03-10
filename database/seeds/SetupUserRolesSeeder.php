<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SetupUserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables();
        $this->createEmployerRole();
        $this->createEmployeeRole();

    }

    public function truncateTables()
    {
        Schema::disableForeignKeyConstraints();

        Role::truncate();
        Permission::truncate();

        Schema::enableForeignKeyConstraints();
    }

    public function createEmployerRole()
    {
        $employer = Role::create(['name' => 'employer']);
        $employerPermission = [
            Permission::create(['name' => 'task:add']),
            Permission::create(['name' => 'task:delete']),
            Permission::create(['name' => 'task:edit']),
            Permission::create(['name' => 'task:update']),
            Permission::create(['name' => 'task:view']),
            Permission::create(['name' => 'diary:add']),
            Permission::create(['name' => 'diary:update']),
            Permission::create(['name' => 'diary:edit']),
            Permission::create(['name' => 'diary:delete']),
            Permission::create(['name' => 'diary:view']),
            Permission::create(['name' => 'user:view']),
            Permission::create(['name' => 'user:delete']),
            Permission::create(['name' => 'user:update']),
            Permission::create(['name' => 'user:edit']),
            Permission::create(['name' => 'project:view']),
            Permission::create(['name' => 'project:delete']),
            Permission::create(['name' => 'project:update']),
            Permission::create(['name' => 'project:edit']),
            Permission::create(['name' => 'project:add']),
            Permission::create(['name' => 'team:view']),
            Permission::create(['name' => 'team:delete']),
            Permission::create(['name' => 'team:update']),
            Permission::create(['name' => 'team:edit']),
            Permission::create(['name' => 'team:add']),
            Permission::create(['name' => 'team:user:view']),
            Permission::create(['name' => 'team:user:delete']),
            Permission::create(['name' => 'team:user:update']),
            Permission::create(['name' => 'team:user:edit']),
            Permission::create(['name' => 'team:user:add']),
            Permission::create(['name' => 'project:user:view']),
            Permission::create(['name' => 'project:user:delete']),
            Permission::create(['name' => 'project:user:update']),
            Permission::create(['name' => 'project:user:edit']),
            Permission::create(['name' => 'project:user:add']),
            Permission::create(['name' => 'project:report:view']),
            Permission::create(['name' => 'project:report:update']),
            Permission::create(['name' => 'project:report:edit']),
        ];

        foreach( $employerPermission as $permission ) {
            $permission->givePermissionTo($employer);
        }
    }

    public function createEmployeeRole()
    {
        $employer = Role::create(['name' => 'employee']);
        $employeePermission = [
            'task:edit',
            'task:update',
            'task:view',
            'diary:view',
            'project:view',
            'project:report:view',
        ];

        $employer->syncPermissions($employeePermission);
    }
}
