<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentActivity;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends BaseController
{
    protected string $model = Student::class;

    public function courses(int $id): JsonResponse
    {
        $teacher = Student::where(['user_id' => $id])
            ->first();

        if (is_null($teacher)) {
            throw (new ModelNotFoundException())->setModel(Student::class, [$id]);
        }

        $courses = $teacher->courses()->get();

        if ($courses->count() == 0) {
            return response()->json(['data' => []]);
        }

        return response()->json(['data' => $courses]);
    }

    public function activities(int $id)
    {
        $teacher = Student::where(['user_id' => $id])
            ->first();

        if (is_null($teacher)) {
            throw (new ModelNotFoundException())->setModel(Student::class, [$id]);
        }

        $activities = $teacher->activities()->get();

        if ($activities->count() == 0) {
            return response()->json(['data' => []]);
        }

        return response()->json(['data' => $activities]);
    }

    public function publishActivity(Request $request): JsonResponse
    {
        $validated = $this->validate($request, [
            'student_id' => 'required|integer|exists:users,id',
            'activity_id' => 'required|integer|exists:activities,id',
            'file' => 'required|file'
        ]);

        $student = Student::where('user_id', $validated['student_id'])->first();

        if (is_null($student)) {
            throw (new ModelNotFoundException())->setModel(Student::class, [$validated['student_id']]);
        }

        $data = array_merge($validated, ['late' => false, 'student_id' => $student->id]);

        StudentActivity::create($data);

        return response()->json(['message' => 'Activity registered with success'], 201);
    }

    public function sendActivity(): JsonResponse
    {
        return response()->json();
    }

    protected function validationRules(): array
    {
        return [];
    }
}
