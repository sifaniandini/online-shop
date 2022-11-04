<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index' , [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);
        $input = $request->all();
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $folderTujuan = 'uploads/';
            $namaFile = time() . "_" . $file->getclientOriginalName();
            $file->move(public_path($folderTujuan), $namaFile);
            $input['gambar'] = $namaFile;
        }
        Category::create($input);
        return redirect(route('categories.index'));
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect(route('categories.index'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', [
            'category'=> $category
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        $input = $request->all();
        $category = Category::find($id);
        $category->update($input);
        return redirect(route('categories.index'));
    }
}
