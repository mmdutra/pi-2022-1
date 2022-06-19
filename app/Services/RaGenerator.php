<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\UserType;

class RaGenerator
{
    public function generate(string $type): string
    {
        $timestamp = (string) (new \DateTime())->getTimestamp();

        $timestamp = substr($timestamp, 0, -2);

        if ($type === UserType::STUDENT) {
            return 'A' . $timestamp;
        }

        return 'P' . $timestamp;
    }
}
