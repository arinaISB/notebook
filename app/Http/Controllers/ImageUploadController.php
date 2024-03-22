<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;

class ImageUploadController extends Controller
{
    public function upload(UploadRequest $request, ImageService $imageService): JsonResponse
    {
        $validatedPhoto = $request->validated();

        $image = $imageService->uploadImage($validatedPhoto['photo']);

        if ($image === null) {
            return response()->json(['error' => 'Failed to upload image'], 500);
        }

        return response()->json($image, 201);
    }
}
