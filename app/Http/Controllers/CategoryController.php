<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Movie;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categorylist', ['categories' => Category::all()]);

    }

    public function create(Request $request)
    {
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('categorylist.index')->with('New Category added !!!');

    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        return view('admin.categorylist', ['categories' => Category::all()]);

    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy($id)
    {
        Category::where('id', $id)->delete();
        return back()->withSuccess('Movie Deleted !!!');
    }
}
