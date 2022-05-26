<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class TeacherController extends Controller
{
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
