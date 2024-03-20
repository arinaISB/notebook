<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Models\Notebook;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Services\ImageService;

class NotebookController extends Controller
{
    public function getAll()
    {
        $notebooks = Notebook::paginate(2);
        return response()->json($notebooks);
    }

    public function create(CreateRequest $request)
    {
        $validated = $request->validated();

        $validator = Validator::make($validated, [
            'phone' => 'unique:notebooks',
            'email' => 'unique:notebooks',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        try {
            DB::transaction(function () use ($validated)
            {
                Notebook::create($validated);
            });

            return response()->json(['success' => 'Notebook created successfully']);
        } catch (\Throwable $exception) {
            Log::error("Notebook not created: {$exception->getMessage()}");

            return response()->json(['error' => 'An error occurred while creating the notebook.']);
        }
    }

    public function upload()
    {
        //            $imageService->uploadAvatar($validated['photo']);
    }
}
