<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\Cart\CartService;
use App\Models\Cart;
use App\Models\CartItem;
use App\Http\Requests\CartRequest; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cartService;

    // Constructor nhận dependency CartService
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    // Hiển thị giỏ hàng của người dùng
    public function index()
    {
        $user = Auth::user();
        $cart = $this->cartService->getCart($user->id); // Lấy giỏ hàng của người dùng
        return view('user.cart.index', [
            'title' => 'Giỏ hàng của bạn',
            'cart' => $cart
        ]);
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add(CartRequest $request) // Sử dụng CartRequest để xác thực
    {
        $user = Auth::user();
        $this->cartService->addToCart($user->id, $request->product_id, $request->quantity);

        return redirect()->route('cart.index');
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function update(CartRequest $request, $cartItemId) // Sử dụng CartRequest để xác thực
    {
        $this->cartService->updateQuantity($cartItemId, $request->quantity);

        return redirect()->route('cart.index');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove(Request $request, $cartItemId)
    {
        $this->cartService->removeFromCart($cartItemId);

        return redirect()->route('cart.index');
    }

    // Xóa toàn bộ giỏ hàng
    public function clear()
    {
        $this->cartService->clearCart();

        return redirect()->route('cart.index');
    }
}
