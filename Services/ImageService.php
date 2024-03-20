<?php

namespace Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function uploadAvatar(UploadedFile $file: bool
    {
        $filename = $file->hashName();
        $extension = $file->extension();

        try {
            $path = Storage::disk('public')->putFileAs('images', $file, $filename);

            Image::create([
                'name' => $filename,
                'type' => $extension,
                'path' => $path,
            ]);

            return true;
        } catch (\Throwable $exception) {
            if ($path && Storage::disk('public')->exists($path))
            {
                Storage::disk('public')->delete($path);
            }
            Log::error("Failed to upload avatar for user {$userId}: {$exception->getMessage()}");
            return false;
        }
    }
}
