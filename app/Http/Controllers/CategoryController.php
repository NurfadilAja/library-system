<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ['Pendidikan', 'Fiksi', 'Komedi', 'Horror', 'Romantis'];

        return view('categories.index', compact('categories'));
    }
}