<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Product;
use Dflydev\DotAccessData\Data;

class ManageProductController extends Controller
{
    public function index(Request $request)
    {
        $productsQuery = Product::orderBy('id', 'desc');

        // Kiểm tra nếu có yêu cầu tìm kiếm
        if ($request->has('search')) {
            // Lấy từ khóa tìm kiếm từ request
            $searchText = $request->input('search');

            // Thực hiện tìm kiếm theo tên sản phẩm
            $productsQuery->where('name', 'LIKE', "%{$searchText}%");
        }

        // Thực hiện phân trang với 10 sản phẩm mỗi trang
        $products = $productsQuery->paginate(10);

        // Trả về view 'admin.Product Management.manageProduct' và truyền dữ liệu sản phẩm vào view
        return view('admin.Product Management.manageProduct', compact('products'));
    }
    public function toggleHide($id)
    {
        $product = Product::findOrFail($id);
        if($product->hide == true){
            $product->hide = false;
        }else{
            $product->hide = true;
        }
        
        $product->save();
        return redirect()->route('products.index');
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

        return redirect()->route('products.index');
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
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        return redirect()->route('products.index');
    }
}
