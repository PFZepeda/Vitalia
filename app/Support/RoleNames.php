<?php

namespace App\Support;

final class RoleNames
{
    public const PATIENT = 'Paciente';
    public const CAREGIVER = 'Cuidador';
    public const DOCTOR = 'Medico';
    public const PHARMACIST = 'Farmaceutico';
    public const ADMIN = 'Admin';

    /**
     * @return array<int, string>
     */
    public static function all(): array
    {
        return [
            self::PATIENT,
            self::CAREGIVER,
            self::DOCTOR,
            self::PHARMACIST,
            self::ADMIN,
        ];
    }
}
