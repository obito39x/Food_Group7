<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Product;
use Dflydev\DotAccessData\Data;

class ManageProductController extends Controller
{
    // Phương thức index để hiển thị trang menu
    public function index()
    {
        // Lấy tất cả sản phẩm từ model Product
        $products = Product::all();

        // Trả về view 'menu' và truyền dữ liệu sản phẩm vào view
        return view('admin.Product Management.manageProduct')->with('products', $products);
    }
    public function create()
    {
        $Categories = Categorie::all();
        return view('admin.Product Management.createProduct')->with('categories', $Categories);
    }

    public function store(Request $request)
    {
        // Validate request
        $data = $request->all(); // Lấy tất cả dữ liệu từ request

        if ($request->hasFile('image')) {
            // Lấy ảnh từ request
            $image = $request->file('image');

            // Lưu ảnh vào thư mục public/image với tên duy nhất
            $imageName = $image->getClientOriginalName(); // Lấy tên gốc của ảnh
            $image->move(public_path('image'), $imageName);

            // Thêm tên ảnh vào mảng thuộc tính
            $data['image_url'] = "image/" . $imageName;
        }
        $data['id_categories'] = $request->input('category');
        // Tạo sản phẩm
        Product::create($data);

        return redirect()->route('manageProduct');
    }

    public function edit(Product $product)
    {
        $Categories = Categorie::all();
        return view('admin.Product Management.editProduct', compact('product'))->with('categories', $Categories);
    }

    public function update(Request $request, $id)
    {
        // Lấy sản phẩm cần cập nhật dựa trên $id
        $product = Product::findOrFail($id);
        // Kiểm tra xem người dùng đã tải lên ảnh mới hay chưa
        if ($request->hasFile('image')) {
            // Lấy ảnh từ request
            $image = $request->file('image');

            // Lưu ảnh vào thư mục public/image với tên duy nhất
            $imageName = $image->getClientOriginalName(); // Lấy tên gốc của ảnh
            $image->move(public_path('image'), $imageName);


            // Cập nhật tên ảnh vào cơ sở dữ liệu
            $product->image_url = "image/" . $imageName;
        }
        $product->id_categories = $request->input('category');
        // Cập nhật thông tin sản phẩm
        $product->update($request->all());

        // Chuyển hướng đến route hiển thị danh sách sản phẩm
        return redirect()->route('manageProduct');
    }

    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        return redirect()->route('manageProduct');
    }
}
