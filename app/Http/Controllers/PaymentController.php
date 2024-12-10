<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        // Hiển thị trang thanh toán
        return view('payment.index');
    }

    public function process(Request $request)
    {
        // Xử lý thanh toán (tích hợp MoMo ở đây)
        $paymentData = $request->all();
        // Gửi yêu cầu đến API của MoMo
        return redirect()->route('payment')->with('success', 'Thanh toán thành công!');
    }
}
