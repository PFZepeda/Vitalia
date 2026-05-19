<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\RoleNames;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        $guard = 'web';

        $demoUsers = [
            RoleNames::CAREGIVER => [
                'name' => env('DEMO_CAREGIVER_NAME', 'Cuidador Demo'),
                'email' => env('DEMO_CAREGIVER_EMAIL', 'cuidador@vitalia.test'),
                'password' => env('DEMO_CAREGIVER_PASSWORD', 'Password123!'),
            ],
            RoleNames::DOCTOR => [
                'name' => env('DEMO_DOCTOR_NAME', 'Doctor Demo'),
                'email' => env('DEMO_DOCTOR_EMAIL', 'medico@vitalia.test'),
                'password' => env('DEMO_DOCTOR_PASSWORD', 'Password123!'),
            ],
            RoleNames::PHARMACIST => [
                'name' => env('DEMO_PHARMACIST_NAME', 'Farmaceutico Demo'),
                'email' => env('DEMO_PHARMACIST_EMAIL', 'farmaceutico@vitalia.test'),
                'password' => env('DEMO_PHARMACIST_PASSWORD', 'Password123!'),
            ],
             RoleNames::PATIENT => [
                'name' => env('DEMO_PATIENT_NAME', 'Paciente Demo'),
                'email' => env('DEMO_PATIENT_EMAIL', 'paciente@vitalia.test'),
                'password'=> env('DEMO_PATIENT_PASSWORD', 'Password123!'),
        ],
        ];

        foreach ($demoUsers as $roleName => $payload) {
            $role = Role::findOrCreate($roleName, $guard);

            $user = User::firstOrCreate(
                ['email' => $payload['email']],
                [
                    'name' => $payload['name'],
                    'password' => Hash::make($payload['password']),
                    'email_verified_at' => now(),
                ]
            );

            if (! $user->getRoleNames()->contains($roleName)) {
                $user->syncRoles([$role]);
            }
        }

        $adminEmail = env('ADMIN_EMAIL', 'admin@vitalia.test');
        $adminRole = Role::findOrCreate(RoleNames::ADMIN, $guard);

        $admin = User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => env('ADMIN_NAME', 'Administrador'),
                'password' => Hash::make((string) env('ADMIN_PASSWORD', 'Admin123!')),
                'email_verified_at' => now(),
            ]
        );

        $admin->syncRoles([$adminRole]);

        $patientRole = Role::findOrCreate(RoleNames::PATIENT, $guard);

        User::doesntHave('roles')->each(function (User $user) use ($patientRole): void {
            $user->assignRole($patientRole);
        });
    }
}
