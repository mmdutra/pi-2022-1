<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class StudentController
{
    public function sendActivity(): JsonResponse
    {
        return response()->json();
    }
}
