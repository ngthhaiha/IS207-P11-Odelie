<?php

namespace App\Http\Services\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ProductAdminService
{   
    public function getCategory()
    {
        return Category::where('isActive', 1)->get();
    }

    protected function isValidPrice($request)
    {
        return true;
    }

    public function insert($request)
    {
        // Kiểm tra giá
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $data = $request->except('_token'); // Lấy dữ liệu cần thiết
            Product::create($data);

            Session::flash('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm sản phẩm lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }

    public function get()
    {
        return Product::with('category') // Sử dụng quan hệ 'category' từ model Product
            ->orderByDesc('id')
            ->paginate(15);
    }

    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $data = $request->except('_token'); // Loại bỏ dữ liệu không cần thiết
            $product->fill($data); // Điền dữ liệu vào sản phẩm
            $product->save(); // Lưu sản phẩm

            Session::flash('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật sản phẩm lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }

    public function delete($request)
    {
        try {
            $product = Product::find($request->input('id'));
            if (!$product) {
                Session::flash('error', 'Sản phẩm không tồn tại');
                return false;
            }

            $product->delete();
            Session::flash('success', 'Xóa sản phẩm thành công');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa sản phẩm lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }
    }
}
