<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends BaseController
{
    protected string $model = Course::class;

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validate($request, $this->validationRules());

        $course = $this->model::create($validated);
        $teacher = Teacher::findOrFail($request->get('teacher_id'));
        $course->teachers()->sync([$teacher->id]);

        return response()->json(['id' => $course->id], 201);
    }

    public function activities(int $id): JsonResponse
    {
        $course = Course::findOrFail($id);

        return response()->json(['data' => $course->activities()->get()]);
    }

    public function findById(int $id): JsonResponse
    {
        $course = Course::findOrFail($id);

        return response()->json(['data' => $course]);
    }

    protected function validationRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'teacher_id' => 'required|integer|exists:users,id'
        ];
    }
}
