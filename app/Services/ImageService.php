<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function uploadAvatar(UploadedFile $file): JsonResponse
    {
        $filename = $file->hashName();
        $extension = $file->extension();

        try {
            $path = Storage::disk('public')->putFileAs('images', $file, $filename);

            $image = Image::create([
                'name' => $filename,
                'type' => $extension,
                'path' => $path,
            ]);

            return response()->json($image->id);
        } catch (\Throwable $exception) {
            if ($path && Storage::disk('public')->exists($path))
            {
                Storage::disk('public')->delete($path);
            }
            Log::error("Failed to upload photo: {$exception->getMessage()}");
            return response()->json(['error' => 'An error occurred while uploading the image']);
        }
    }
}
