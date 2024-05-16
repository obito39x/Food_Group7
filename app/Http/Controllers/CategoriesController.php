<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('admin.Categories.categories', compact('categories'));
    }
    public function create()
    {

        return view('admin.Categories.createcategories');
    }
    public function store(Request $request)
    {
        // Validate request
        $data = $request->all(); // Lấy tất cả dữ liệu từ request
        // Tạo sản phẩm
        Categorie::create($data);
        return redirect()->route('categories');
    }
    public function destroy($id)
    {

        Categorie::destroy($id);
        return redirect()->route('categories');
    }
    public function edit(Categorie $category)
    {
        return view('admin.Categories.updatecategories', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $category = Categorie::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories');
    }
}
