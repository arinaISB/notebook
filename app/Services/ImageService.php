<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function uploadImage(UploadedFile $file): ?Image
    {
        $filename = $file->hashName();
        $extension = $file->extension();

        try {
            $path = Storage::disk('public')->putFileAs('images', $file, $filename);

            return Image::create([
                'name' => $filename,
                'type' => $extension,
                'path' => $path,
            ]);
        } catch (\Throwable $exception) {
            if ($path && Storage::disk('public')->exists($path))
            {
                Storage::disk('public')->delete($path);
            }
            Log::error("Failed to upload photo: {$exception->getMessage()}");
            return null;
        }
    }
}
