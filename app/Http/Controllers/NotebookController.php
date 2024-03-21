<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\UploadRequest;
use App\Models\Notebook;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class NotebookController extends Controller
{
    public function getAll(): JsonResponse
    {
        $notebooks = Notebook::paginate(2);
        return response()->json($notebooks);
    }

    public function create(CreateRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        try {
            $notebook = Notebook::create($validatedData);

            return response()->json($notebook);
        } catch (\Throwable $exception) {
            Log::error("Notebook not created: {$exception->getMessage()}");

            return response()->json(['error' => 'An error occurred while creating the notebook.']);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $notebook = Notebook::findOrFail($id);

            return response()->json($notebook);
        } catch (\Throwable $exception) {
            Log::error("Failed to find notebook: {$exception->getMessage()}");

            return response()->json(['error' => 'Notebook not found.']);
        }
    }

    public function uploadPhoto(UploadRequest $request, ImageService $imageService): JsonResponse
    {
        $validatedPhoto = $request->validated();

        try {
            $image = isset($validatedPhoto['photo']) ? $imageService->uploadAvatar($validatedPhoto['photo']) : null;

            return response()->json($image);
        } catch (\Throwable $exception) {
            Log::error("Failed to upload photo: {$exception->getMessage()}");

            return response()->json(['error' => 'An error occurred while uploading the photo']);
        }
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();

        $notebook = Notebook::findOrFail($id);
        $notebook->update($validatedData);

        return response()->json($notebook);
    }

    public function delete(int $id): JsonResponse
    {
            $notebook = Notebook::findOrFail($id);
            $notebook->delete();

            return response()->json($notebook);
    }
}
