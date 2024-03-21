<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\UploadRequest;
use App\Models\Notebook;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class NotebookController extends Controller
{
    public function getAll()
    {
        $notebooks = Notebook::paginate(2);
        return response()->json($notebooks);
    }

    public function create(CreateRequest $request, $photoId = null)
    {
        $validatedData = $request->validated();
        Log::info($photoId);

        $validator = Validator::make($validatedData, [
            'phone' => 'unique:notebooks',
            'email' => 'unique:notebooks',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        try {
            DB::transaction(function () use ($validatedData, $photoId)
            {
                Log::info('Creating notebook with photo ID:', ['photo_id' => $photoId]); // Отладка перед созданием записи
                Notebook::create(array_merge($validatedData, ['image_id' => $photoId]));
            });

            return response()->json(['success' => 'Notebook created successfully']);
        } catch (\Throwable $exception) {
            Log::error("Notebook not created: {$exception->getMessage()}");
            return response()->json(['error' => 'An error occurred while creating the notebook.']);
        }
    }

    public function uploadPhoto(UploadRequest $request, ImageService $imageService): JsonResponse
    {
        $validatedPhoto = $request->validated();

        try {
            $photoId = isset($validatedPhoto['photo']) ? $imageService->uploadAvatar($validatedPhoto['photo']) : null;

            return response()->json($photoId);
        } catch (\Throwable $exception) {
            Log::error("Failed to upload photo: {$exception->getMessage()}");

            return response()->json(['error' => 'An error occurred while uploading the photo']);
        }
    }

    public function update(UpdateRequest $request, $id): JsonResponse
    {
        $validatedData = $request->validated();
        Log::info($validatedData);

        $validator = Validator::make($validatedData, [
            'phone' => 'unique:notebooks',
            'email' => 'unique:notebooks',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        try {
            $notebook = Notebook::findOrFail($id);
            $notebook->update($validatedData);

            return response()->json(['success' => 'Notebook updated successfully']);
        } catch (\Throwable $exception) {
            Log::error("Notebook not updated: {$exception->getMessage()}");

            return response()->json(['error' => 'An error occurred while updating the notebook.']);
        }
    }

    public function delete($id)
    {
        try {
            $notebook = Notebook::findOrFail($id);
            $notebook->delete();

            return response()->json(['success' => 'Notebook deleted successfully']);
        } catch (\Throwable $exception) {
            Log::error("Notebook not deleted: {$exception->getMessage()}");

            return response()->json(['error' => 'An error occurred while deleting the notebook.']);
        }
    }
}
