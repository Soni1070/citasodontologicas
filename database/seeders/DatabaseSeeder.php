<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Database\Seeders\ConsultorioSeeder;
use Database\Seeders\HorarioSeeder;
use Database\Seeders\PacienteSeeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // ======================
// CREAR USUARIOS BASE
// ======================

$adminUser = User::firstOrCreate(
    ['email' => 'admin@admin.com'],
    [
        'name' => 'Administrador',
        'password' => Hash::make('password'),
    ]
);

$secretaria1 = User::firstOrCreate(
    ['email' => 'secretaria1@admin.com'],
    [
        'name' => 'Secretaria 1',
        'password' => Hash::make('password'),
    ]
);

$secretaria2 = User::firstOrCreate(
    ['email' => 'secretaria2@admin.com'],
    [
        'name' => 'Secretaria 2',
        'password' => Hash::make('password'),
    ]
);

$dentista1 = User::firstOrCreate(
    ['email' => 'dentista1@admin.com'],
    [
        'name' => 'Dentista 1',
        'password' => Hash::make('password'),
    ]
);

$dentista2 = User::firstOrCreate(
    ['email' => 'dentista2@admin.com'],
    [
        'name' => 'Dentista 2',
        'password' => Hash::make('password'),
    ]
);
        // Limpiar cache de permisos
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | ROLES
        |--------------------------------------------------------------------------
        */
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $secretaria = Role::firstOrCreate(['name' => 'secretaria', 'guard_name' => 'web']);
        $dentista = Role::firstOrCreate(['name' => 'dentista', 'guard_name' => 'web']);
        $paciente = Role::firstOrCreate(['name' => 'paciente', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'usuario', 'guard_name' => 'web']);

        /*
        |--------------------------------------------------------------------------
        | PERMISOS
        |--------------------------------------------------------------------------
        */
        $permisos = [
    // Usuarios
    'ver usuarios',
    'crear usuarios',
    'editar usuarios',
    'eliminar usuarios',

    // Módulos del panel
    'ver secretarias',
    'ver pacientes',
    'ver consultorios',
    'ver dentistas',
    'ver horarios',

    // Citas
    'ver citas',
    'crear citas',
    'editar citas',
    'cancelar citas',
];

foreach ($permisos as $permiso) {
    Permission::firstOrCreate([
        'name' => $permiso,
        'guard_name' => 'web',
    ]);
}

        /*
        |--------------------------------------------------------------------------
        | ASIGNAR PERMISOS A ROLES (FORMA CORRECTA)
        |--------------------------------------------------------------------------
        */
        $admin->syncPermissions(Permission::all());

        $secretaria->syncPermissions([
            'ver pacientes',
            'ver consultorios',
            'ver dentistas',
            'ver horarios',
            'ver citas',
            'crear citas',
            'editar citas',
            'cancelar citas',
        ]);

        $dentista->syncPermissions([
            'ver horarios',
            'ver citas',
            'editar citas',
        ]);

        $paciente->syncPermissions([
            'ver citas',
            'crear citas',
            'cancelar citas',
        ]);

        /*
        |--------------------------------------------------------------------------
        | ASIGNAR ROLES A USUARIOS
        |--------------------------------------------------------------------------
        */
        if ($adminUser = User::where('email', 'admin@admin.com')->first()) {
            $adminUser->syncRoles('admin');
        }

        User::whereIn('email', [
            'secretaria1@admin.com',
            'secretaria2@admin.com',
        ])->each(fn ($user) => $user->syncRoles('secretaria'));

        User::whereIn('email', [
            'dentista1@admin.com',
            'dentista2@admin.com',
        ])->each(fn ($user) => $user->syncRoles('dentista'));

        /*
        |--------------------------------------------------------------------------
        | OTROS SEEDERS
        |--------------------------------------------------------------------------
        */
        $this->call([
            ConsultorioSeeder::class,
            HorarioSeeder::class,
            PacienteSeeder::class,
        ]);
    }
}
