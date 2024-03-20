<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;

class NotebookController extends Controller
{
    public function notebook()
    {
        $notebooks = Notebook::paginate(2);
        return view('notebook', ['notebooks' => $notebooks]);
    }
}
