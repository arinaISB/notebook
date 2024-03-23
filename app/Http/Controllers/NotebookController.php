<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Notebook;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class NotebookController extends Controller
{
    public function getAll(): JsonResponse
    {
        $notebooks = Notebook::paginate(2);
        return response()->json($notebooks, 200);
    }

    public function create(CreateRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        try {
            $notebook = Notebook::create($validatedData);

            return response()->json($notebook, 200);
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage());
            return response()->json(['error' => 'An error occurred while creating the notebook.'], 400);
        }
    }

    public function getOneById(int $id): JsonResponse
    {
        try {
            $notebook = Notebook::findOrFail($id);

            return response()->json($notebook, 200);
        } catch (\Throwable) {
            return response()->json(['error' => 'Notebook not found.'], 404);
        }
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();

        $notebook = Notebook::find($id);

        if (!$notebook) {
            return response()->json(['error' => 'Notebook not found.'], 404);
        }

        $notebook->update($validatedData);

        return response()->json($notebook, 200);
    }

    public function delete(int $id)
    {
        $notebook = Notebook::find($id);

        if (!$notebook) {
            return response()->json(['error' => 'Notebook not found.'], 404);
        }

        $notebook->delete();

        return response(status: 204);
    }
}
