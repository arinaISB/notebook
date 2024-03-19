<?php

namespace App\Models;

use Database\Factories\NotebookFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'father_name',
        'company_name',
        'phone',
        'email',
        'birth_date',
        'photo',
    ];

    protected string $factory = NotebookFactory::class;

}
