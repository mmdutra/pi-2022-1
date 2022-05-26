<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as LaravelController;

abstract class BaseController extends LaravelController
{
    protected string $model;

    protected array $validationRules = [];
    protected array $validationMessages = [];

    abstract protected function validationRules(): array;

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validate(
            request: $request,
            rules: $this->validationRules,
            messages: $this->validationMessages
        );

        $register = $this->model::create($validated);

        return response()->json(['id' => $register->id], 201);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $register = $this->model::findOrFail($id);

        $validated = $this->validate(
            request: $request,
            rules: $this->validationRules,
            messages: $this->validationMessages
        );

        $register->fill($validated);
        $register->save();

        return response()->json([], 200);
    }

    public function all(): JsonResponse
    {
        return $this->model::all();
    }

    public function delete(int $id): JsonResponse
    {
        $register = $this->model::findOrFail($id);
        $register->delete();

        return response()->json([], 204);
    }
}
