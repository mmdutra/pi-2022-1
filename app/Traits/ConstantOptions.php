<?php

declare(strict_types=1);

namespace App\Traits;

trait ConstantOptions
{
    public static function options(): array
    {
        $reflectionClass = new \ReflectionClass(self::class);

        return array_values($reflectionClass->getConstants());
    }
}
