<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\User;
use App\Services\RaGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        $data = $this->validate(
            request: $request,
            rules: $this->validationRules(),
            messages: $this->validationMessages
        );

        $ra = $this->generator->generate($request->get('type'));

        $data = array_merge($data, ['ra' => $ra]);

        $register = $this->model::create($data);

        return response()->json(['id' => $register->id], 201);
    }

    protected function validationRules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique|min:3',
            'ra' => 'required|string|min:9|max:9',
            'type' => ['required', Rule::in(UserType::options())]
        ];
    }
}
