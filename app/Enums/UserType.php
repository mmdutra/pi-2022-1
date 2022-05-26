<?php

declare(strict_types=1);

namespace App\Enums;

use App\Traits\ConstantOptions;

class UserType
{
    use ConstantOptions;

    public const STUDENT = 'student';
    public const TEACHER = 'teacher';
}
