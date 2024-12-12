<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="wishlist.css" rel="stylesheet" />
    <title>Wishlist</title>
</head>

<body>
    <div class="v73_22250">
        <!-- Tiêu đề Wishlist -->
        <span class="v73_22296">DANH SÁCH YÊU THÍCH</span>
        <div class="v73_22251"><span class="v73_22252">Thanh toán</span></div>

        <!-- Kiểm tra wishlist trống -->
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if ($wishlistItems->isEmpty())
            <p>Danh sách yêu thích của bạn hiện tại trống.</p>
        @else
            <!-- Danh sách sản phẩm trong wishlist -->
            <div class="v73_22256">
                @foreach ($wishlistItems as $item)
                    <div class="v73_22257">
                        <!-- Hình ảnh sản phẩm -->
                        <div class="v73_22258">
                            <img src="{{ $item->product->image_url }}" alt="product-image" />
                        </div>
                        <!-- Chi tiết sản phẩm -->
                        <div class="v73_22259">
                            <span class="v73_22264">{{ $item->product->name }}</span>
                            <span class="product-color">Màu: {{ $item->product->color }}</span>
                            <span class="v73_22258">
                                Giá: {{ number_format($item->product->price, 0, ',', '.') }}₫
                            </span>
                        </div>

                        <!-- Thao tác xóa sản phẩm khỏi wishlist -->
                        <div class="v73_22261">
                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="v73_22262">Xóa</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>

</html>
