<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            ['name' => 'category.index'],
            ['name' => 'category.create'],
            ['name' => 'category.edit'],
            ['name' => 'category.destroy'],
            ['name' => 'category.viewimport'],

            ['name' => 'customer.index'],
            ['name' => 'customer.create'],
            ['name' => 'customer.edit'],
            ['name' => 'customer.show'],
            ['name' => 'customer.destroy'],
            ['name' => 'customer.import'],  

            ['name' => 'team.index'],
            ['name' => 'team.create'],
            ['name' => 'team.edit'],
            ['name' => 'team.destroy'],

            ['name' => 'quote.index'],
            ['name' => 'quote.create'],
            ['name' => 'quote.show'],
            ['name' => 'quote.edit'],
            ['name' => 'quote.destroy'],
            ['name' => 'quote.quotepdf'],
            ['name' => 'quote.sendEmailQuotepdf'],
            ['name' => 'quote.cambiarStatus'],
            ['name' => 'quote.addReferencias'],

            ['name' => 'user.index'],
            ['name' => 'user.create'],
            ['name' => 'user.show'],
            ['name' => 'user.edit'],
            ['name' => 'user.destroy'],

            ['name' => 'maintenance.index'],
            ['name' => 'maintenance.create'],
            ['name' => 'maintenance.show'],
            ['name' => 'maintenance.edit'],
            ['name' => 'maintenance.destroy'],
            ['name' => 'maintenance.cambiarStatus'],
            ['name' => 'maintenance.exportar'],
            ['name' => 'maintenance.store_file_invoice'],

            ['name' => 'recordatorio.index'],

            ['name' => 'settings.index'],
            ['name' => 'settings.edit'],

            ['name' => 'role.index'],
            ['name' => 'role.create'],
            ['name' => 'role.show'],
            ['name' => 'role.edit'],
            ['name' => 'role.destroy'],
        ];
        $superadmin =Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Administrador']);
        foreach ($permisos as $item) {
            Permission::create(['name' => $item['name'], 'guard_name' => 'web']);
            $admin->givePermissionTo($item['name']);
        }
    }
}
