<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class TeacherController extends Controller
{
    public function courses(int $id): JsonResponse
    {
        $teacher = Teacher::where(['user_id' => $id])
            ->first();

        if (is_null($teacher)) {
            throw (new ModelNotFoundException())->setModel(Teacher::class, [$id]);
        }

        $courses = $teacher->courses()->get();

        if ($courses->count() == 0) {
            return response()->json(['data' => []]);
        }

        return response()->json(['data' => $courses]);
    }

    public function publishAbsences(Request $request): JsonResponse
    {
        $this->validate($request, [
            'students' => 'required|array|exists_in:students'
        ]);

        return response()->json();
    }

    public function publishGrades(Request $request): JsonResponse
    {
        $this->validate($request, [
            'student_grades'  => 'required|array'
        ]);

        return response()->json();
    }
}
