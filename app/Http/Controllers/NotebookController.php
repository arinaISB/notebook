<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotebookController extends Controller
{
    public function notebook()
    {
        return view('notebook');
    }
}
