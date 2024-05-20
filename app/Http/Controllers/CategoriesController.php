<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
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
        return redirect()->route('categories.index');
    }
    public function destroy($id)
    {
        $relatedRecords = Product::where('id_categories', $id)->exists(); // Ví dụ: Sử dụng Product model và category_id là khóa ngoại

        if ($relatedRecords) {
            // Nếu có bản ghi liên quan, hiển thị thông báo cảnh báo
            return redirect()->route('categories.index')->with('warning', 'Cannot delete this category because it is being used in other records.');
        } else {
            // Nếu không có bản ghi liên quan, xóa danh mục và chuyển hướng
            Categorie::destroy($id);
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        }
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

        return redirect()->route('categories.index');
    }
}
