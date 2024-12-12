<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="cart.css" rel="stylesheet" />
    <title>Giỏ Hàng</title>
</head>

<body>
    <div class="v73_22250">
        <!-- Tiêu đề Giỏ hàng -->
        <span class="v73_22296">GIỎ HÀNG</span>
        <div class="v73_22251"><span class="v73_22252">Thanh toán</span></div>

        <!-- Kiểm tra giỏ hàng trống -->
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if ($cartItems->isEmpty())
            <p>Giỏ hàng của bạn hiện tại trống.</p>
        @else
            <!-- Danh sách sản phẩm trong giỏ hàng -->
            <div class="v73_22256">
                @foreach ($cartItems as $item)
                    <div class="v73_22257">
                        <!-- Hình ảnh sản phẩm -->
                        <div class="v73_22258">
                            <img src="{{ $item->product->image_url }}" alt="product-image" />
                        </div>
                        <!-- Chi tiết sản phẩm -->
                        <div class="v73_22259">
                            <span class="v73_22264">{{ $item->product->name }}</span>
                            <span class="product-color">Màu: {{ $item->product->color }}</span>
                            <span class="product-quantity">Số lượng: 
                                <input type="number" class="quantity-input" value="{{ $item->quantity }}" min="1" data-id="{{ $item->id }}" />
                            </span>
                            <span class="v73_22258">
                                Giá: {{ number_format($item->product->price, 0, ',', '.') }}₫
                            </span>
                            <span class="v73_22260">Tổng: 
                                {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}₫
                            </span>
                        </div>

                        <!-- Thao tác xóa sản phẩm -->
                        <div class="v73_22261">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="v73_22262">Xóa</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Hiển thị tổng số tiền -->
            <span class="v73_22253">THÀNH TIỀN</span>
            <span class="v73_22254">{{ number_format($totalPrice, 0, ',', '.') }}₫</span>

            <!-- Nút thanh toán -->
            <div class="v73_22265">
                <a href="{{ route('checkout.index') }}">
                    <button class="v73_22266">Thanh toán</button>
                </a>
            </div>
        @endif
    </div>

    <script>
        // Cập nhật số lượng sản phẩm trong giỏ hàng khi thay đổi
        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('change', function() {
                var productId = this.getAttribute('data-id');
                var newQuantity = this.value;

                // Gửi yêu cầu AJAX để cập nhật số lượng sản phẩm
                fetch('/cart/update/' + productId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: newQuantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Cập nhật lại tổng số tiền
                    document.querySelector('.v73_22254').innerText = data.newTotal + '₫';
                    alert('Số lượng đã được cập nhật!');
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>

</html>
