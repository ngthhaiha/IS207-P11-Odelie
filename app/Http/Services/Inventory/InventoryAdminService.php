<?php

namespace App\Http\Services\Inventory;

use App\Models\Inventory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class InventoryAdminService
{
    /**
     * Lấy tất cả thông tin kho hàng.
     */
    public function getAllInventory()
    {
        return Inventory::with('product') // Quan hệ với bảng products (nếu có)
            ->orderByDesc('id')
            ->paginate(15);
    }

    /**
     * Thêm thông tin kho hàng mới.
     */
    public function addInventory($request)
    {
        // Kiểm tra thông tin nhập vào
        $product = Product::find($request->product_id);
        if (!$product) {
            Session::flash('error', 'Sản phẩm không tồn tại');
            return false;
        }

        try {
            $data = $request->except('_token');
            Inventory::create($data); // Thêm thông tin kho hàng vào database

            Session::flash('success', 'Thêm kho hàng thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm kho hàng lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }

    /**
     * Cập nhật thông tin kho hàng.
     */
    public function updateInventory($inventory, $request)
    {
        try {
            $data = $request->except('_token');
            $inventory->fill($data); // Cập nhật thông tin
            $inventory->save(); // Lưu lại thông tin đã cập nhật

            Session::flash('success', 'Cập nhật kho hàng thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật kho hàng lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }

    /**
     * Xóa thông tin kho hàng.
     */
    public function deleteInventory($id)
    {
        try {
            $inventory = Inventory::find($id);
            if (!$inventory) {
                Session::flash('error', 'Kho hàng không tồn tại');
                return false;
            }

            $inventory->delete(); // Xóa kho hàng

            Session::flash('success', 'Xóa kho hàng thành công');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa kho hàng lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }
    }

    /**
     * Kiểm tra số lượng hàng trong kho và cảnh báo nếu gần hết.
     */
    public function checkInventoryStockLevel($inventory)
    {
        // Giới hạn cảnh báo là dưới 10 sản phẩm
        if ($inventory->quantity < 10) {
            return "Cảnh báo: Kho hàng cho sản phẩm '" . $inventory->product->name . "' còn ít!";
        }
        return null;
    }
}
