<?php

namespace App\Http\Services;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class WishlistService
{
    // Lấy danh sách sản phẩm trong wishlist của người dùng
    public function getWishlist($userId)
    {
        return Wishlist::where('user_id', $userId)->get();
    }

    // Thêm sản phẩm vào danh sách yêu thích
    public function addToWishlist($userId, $productId)
    {
        try {
            $wishlistItem = Wishlist::firstOrCreate([
                'user_id' => $userId,
                'product_id' => $productId
            ]);

            Session::flash('success', 'Thêm sản phẩm vào danh sách yêu thích thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm sản phẩm vào danh sách yêu thích lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }

    // Xóa sản phẩm khỏi danh sách yêu thích
    public function removeFromWishlist($userId, $productId)
    {
        try {
            $wishlistItem = Wishlist::where('user_id', $userId)
                                     ->where('product_id', $productId)
                                     ->first();
            if ($wishlistItem) {
                $wishlistItem->delete();
                Session::flash('success', 'Xóa sản phẩm khỏi danh sách yêu thích thành công');
            } else {
                Session::flash('error', 'Sản phẩm không tồn tại trong danh sách yêu thích');
                return false;
            }
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa sản phẩm khỏi danh sách yêu thích lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }
}
