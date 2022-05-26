<?php

declare(strict_types=1);

namespace Tests\Unit\Traits;

use App\Traits\ConstantOptions;
use Tests\TestCase;

class ConstantOptionsTest extends TestCase
{
    public function testShouldReturnTheConstantsAsArray()
    {
        $class = new class {
            use ConstantOptions;

            public const CONST_1 = 'const_1';
            public const CONST_2 = 'const_2';
        };

        $this->assertEquals(
            ['const_1', 'const_2'],
            $class::options()
        );
    }
}
