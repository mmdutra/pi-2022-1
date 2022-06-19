<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Services\RaGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends BaseController
{
    protected string $model = User::class;
    protected array $validationMessages = [];

    public function __construct(private RaGenerator $generator)
    {
    }

    public function me(): JsonResponse
    {
        return response()->json(
            auth()->user()
        );
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validate(
            request: $request,
            rules: $this->validationRules(),
            messages: $this->validationMessages
        );

        $ra = $this->generator->generate($request->get('type'));
        $password = Hash::make($validated['password']);

        $validated = array_merge($validated, [
            'ra' => $ra,
            'password' => $password
        ]);

        $register = $this->model::create($validated);

        if ($validated['type'] === UserType::STUDENT) {
            Student::create([
                'user_id' => $register->id,
                'status' => true,
                'average' => 0
            ]);
        } else {
            Teacher::create([
                'user_id' => $register->id,
                'degree' => $request->get('degree'),
            ]);
        }

        return response()->json(['id' => $register->id], 201);
    }

    protected function validationRules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email|min:3',
            'ra' => 'nullable|string|min:9|max:9',
            'type' => ['required', Rule::in(UserType::options())],
            'password' => 'nullable|string'
        ];
    }
}
