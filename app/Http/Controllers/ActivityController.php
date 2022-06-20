<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\JsonResponse;

class ActivityController extends BaseController
{
    protected string $model = Activity::class;

    public function findById(int $id): JsonResponse
    {
        $course = Activity::findOrFail($id);

        return response()->json(['data' => $course]);
    }

    protected function validationRules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'due_date' => 'required|date|after:now',
            'available' => 'nullable|boolean',
            'course_id' => 'required|exists:courses,id'
        ];
    }
}
