<?php

declare(strict_types=1);

namespace App\Enums;

use App\Traits\ConstantOptions;

class TeacherDegree
{
    use ConstantOptions;

    public const MASTER = 'Me.';
    public const DOCTOR = 'Dr.';
    public const TEACHER = 'Pr.';
}
