<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Enums\UserType;
use App\Services\RaGenerator;
use Tests\TestCase;

class RaGeneratorTest extends  TestCase
{
    public function testGenerateRa()
    {
        $this->assertStringStartsWith(
            'A',
            (new RaGenerator())->generate(UserType::STUDENT)
        );

        $this->assertStringStartsWith(
            'P',
            (new RaGenerator())->generate(UserType::TEACHER)
        );
    }
}
