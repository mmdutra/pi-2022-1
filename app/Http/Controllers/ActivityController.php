<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Activity;

class ActivityController extends BaseController
{
    protected string $model = Activity::class;

    protected function validationRules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'due_date' => 'required|datetime|after:now',
            'available' => 'nullable|boolean',
        ];
    }
}
