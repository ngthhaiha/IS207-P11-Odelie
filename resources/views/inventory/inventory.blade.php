<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="inventory.css" rel="stylesheet" />
    <title>Kho Hàng</title>
</head>

<body>
    <div class="v73_22250">
        <!-- Tiêu đề Kho hàng -->
        <span class="v73_22296">KHO HÀNG</span>
        <div class="v73_22251"><span class="v73_22252">Quản lý sản phẩm</span></div>

        <!-- Kiểm tra kho trống -->
        @if ($inventoryItems->isEmpty())
            <p>Kho hàng hiện tại trống.</p>
        @else
            <!-- Danh sách sản phẩm trong kho -->
            <div class="v73_22256">
                @foreach ($inventoryItems as $item)
                    <div class="v73_22257">
                        <!-- Hình ảnh sản phẩm -->
                        <div class="v73_22258">
                            <img src="{{ $item->image_url }}" alt="product-image" />
                        </div>
                        <!-- Chi tiết sản phẩm -->
                        <div class="v73_22259">
                            <span class="v73_22264">{{ $item->name }}</span>
                            <span class="product-color">Màu: {{ $item->color }}</span>
                            <span class="v73_22258">
                                Giá: {{ number_format($item->price, 0, ',', '.') }}₫
                            </span>
                            <span class="product-quantity">Số lượng: 
                                <input type="number" class="quantity-input" value="{{ $item->quantity }}" min="0" data-id="{{ $item->id }}" />
                            </span>
                        </div>
                        
                        <!-- Thao tác cập nhật số lượng -->
                        <div class="v73_22261">
                            <form action="{{ route('inventory.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="v73_22262">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>

</html>
