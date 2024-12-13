<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\Wishlist\WishlistService;
use App\Http\Requests\WishlistRequest; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    protected $wishlistService;

    // Constructor nhận dependency WishlistService
    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    // Hiển thị danh sách yêu thích của người dùng
    public function index()
    {
        $user = Auth::user();
        $wishlist = $this->wishlistService->getWishlist($user->id); // Lấy danh sách yêu thích của người dùng
        return view('user.wishlist.index', [
            'title' => 'Danh sách yêu thích',
            'wishlist' => $wishlist
        ]);
    }

    // Thêm sản phẩm vào danh sách yêu thích
    public function add(WishlistRequest $request) // Sử dụng WishlistRequest để xác thực
    {
        $user = Auth::user();
        $this->wishlistService->addToWishlist($user->id, $request->product_id);

        return redirect()->route('wishlist.index');
    }

    // Xóa sản phẩm khỏi danh sách yêu thích
    public function remove($wishlistId)
    {
        $this->wishlistService->removeFromWishlist($wishlistId);

        return redirect()->route('wishlist.index');
    }
}
