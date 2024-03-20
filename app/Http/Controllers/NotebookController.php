<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotebookController extends Controller
{
    public function getAll()
    {
        $notebooks = Notebook::paginate(2);
        return view('notebook', ['notebooks' => $notebooks]);
    }

    public function create(CreateRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($validated)
            {
                Notebook::create($validated);
            });

            return response()->json(['success' => 'Notebook created successfully']);
        } catch (\Throwable $exception) {
            return response()->json(['error' => 'Notebook not created', 'message' => $exception->getMessage()]);
        }
    }

    public function getCreateForm()
    {
        return view('createForm');
    }
}
