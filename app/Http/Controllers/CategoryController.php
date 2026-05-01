<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
{
    // Eager loading: ambil induk, anak, dan cucu dalam 1 query (biar nggak lemot)
    $navCategories = Category::whereNull('parent_id')
                        ->with('children.children')
                        ->get();

    return view('welcome', compact('navCategories'));
}
}
