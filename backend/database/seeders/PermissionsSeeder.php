<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and perimssions
        app()[
            \Spatie\Permission\PermissionRegistrar::class
        ]->forgetCachedPermissions();

        // create permissions
        $arrayOfPermissionNames = [
            // Faculties
            "access faculties",
            "create faculties",
            "update faculties",
            "delete faculties",
            // Departments
            "access departments",
            "create departments",
            "update departments",
            "delete departments",
            // Programmes
            "access programmes",
            "create programmes",
            "update programmes",
            "delete programmes",
            // Accreditations
            "access accreditations",
            "create accreditations",
            "update accreditations",
            "delete accreditations",
        ];
        $permissions = collect($arrayOfPermissionNames)->map(function (
            $permission
        ) {
            return ["name" => $permission, "guard_name" => "web"];
        });

        Permission::insert($permissions->toArray());

        // create role & give it permissions
        Role::create(["name" => "programme_leader"])
        ->givePermissionTo([
            "access faculties",
            "create faculties",
            "update faculties",
            "delete faculties",
            "access departments",
            "create departments",
            "update departments",
            "delete departments",
            "access accreditations",
            "create accreditations",
            "update accreditations",
            "delete accreditations"
        ]);
        Role::create(["name" => "programme_coordinator"])
        ->givePermissionTo([
            "access faculties",
            "access departments",
            "create departments",
            "update departments",
            "delete departments",
            "access programmes",
            "create programmes",
            "update programmes",
            "delete programmes",
        ]);
        Role::create(["name" => "qmec"])
        ->givePermissionTo([
            "access accreditations",
            "update accreditations",
        ]);

        // Assign roles to users (in this case for user id -> 1 & 2)
        User::find(1)->assignRole('programme_leader');
        User::find(2)->assignRole('programme_coordinator');
        User::find(3)->assignRole('qmec');
    }
}
