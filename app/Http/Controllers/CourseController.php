<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends BaseController
{
    protected string $model = Course::class;

    protected function validationRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255'
        ];
    }
}
