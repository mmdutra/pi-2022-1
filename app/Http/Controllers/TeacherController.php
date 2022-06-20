<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
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

        return response()->json(['data' => $courses->toArray()]);
    }
}
