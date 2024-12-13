<?php

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CartService
{
    // Lấy giỏ hàng từ session
    public function getCart()
    {
        return Session::get('cart', []);
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart($productId, $quantity, $color = null, $size = null)
    {
        try {
            $cart = $this->getCart();

            // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $product = Product::find($productId);
                $cart[$productId] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'color' => $color,
                    'size' => $size,
                    'price' => $product->price
                ];
            }

            // Lưu giỏ hàng vào session
            Session::put('cart', $cart);
            Session::flash('success', 'Thêm sản phẩm vào giỏ hàng thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm sản phẩm vào giỏ hàng lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }

    // Cập nhật thông tin giỏ hàng (số lượng, màu sắc, kích cỡ)
    public function updateCart($productId, $quantity, $color = null, $size = null)
    {
        try {
            $cart = $this->getCart();

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $quantity;
                $cart[$productId]['color'] = $color;
                $cart[$productId]['size'] = $size;
                Session::put('cart', $cart);
                Session::flash('success', 'Cập nhật giỏ hàng thành công');
            } else {
                Session::flash('error', 'Sản phẩm không có trong giỏ hàng');
                return false;
            }
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật giỏ hàng lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($productId)
    {
        try {
            $cart = $this->getCart();

            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                Session::put('cart', $cart);
                Session::flash('success', 'Xóa sản phẩm khỏi giỏ hàng thành công');
            } else {
                Session::flash('error', 'Sản phẩm không có trong giỏ hàng');
                return false;
            }
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa sản phẩm khỏi giỏ hàng lỗi: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }

    // Xóa toàn bộ giỏ hàng
    public function clearCart()
    {
        try {
            Session::forget('cart');
            Session::flash('success', 'Giỏ hàng đã được làm sạch');
        } catch (\Exception $err) {
            Session::flash('error', 'Lỗi khi làm sạch giỏ hàng: ' . $err->getMessage());
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }
}
