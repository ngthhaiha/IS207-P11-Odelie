<?php

namespace App\Http\Services;

use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ProductVariantService
{
    // Lấy danh sách biến thể sản phẩm
    public function getVariants($productId)
    {
        try {
            return ProductVariant::where('product_id', $productId)->get();
        } catch (\Exception $err) {
            Session::flash('error', 'Lỗi khi lấy thông tin biến thể sản phẩm: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }
    }

    // Tạo mới biến thể sản phẩm
    public function createVariant($productId, $variantData)
    {
        try {
            $productVariant = new ProductVariant();
            $productVariant->product_id = $productId;
            $productVariant->name = $variantData['name'];
            $productVariant->price = $variantData['price'];
            $productVariant->stock_quantity = $variantData['stock_quantity'];
            $productVariant->save();

            Session::flash('success', 'Tạo biến thể sản phẩm thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Tạo biến thể sản phẩm lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }

    // Cập nhật biến thể sản phẩm
    public function updateVariant($variantId, $variantData)
    {
        try {
            $productVariant = ProductVariant::find($variantId);
            if ($productVariant) {
                $productVariant->name = $variantData['name'];
                $productVariant->price = $variantData['price'];
                $productVariant->stock_quantity = $variantData['stock_quantity'];
                $productVariant->save();

                Session::flash('success', 'Cập nhật biến thể sản phẩm thành công');
            } else {
                Session::flash('error', 'Biến thể sản phẩm không tồn tại');
                return false;
            }
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật biến thể sản phẩm lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }

    // Xóa biến thể sản phẩm
    public function deleteVariant($variantId)
    {
        try {
            $productVariant = ProductVariant::find($variantId);
            if ($productVariant) {
                $productVariant->delete();
                Session::flash('success', 'Xóa biến thể sản phẩm thành công');
            } else {
                Session::flash('error', 'Biến thể sản phẩm không tồn tại');
                return false;
            }
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa biến thể sản phẩm lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }
}
