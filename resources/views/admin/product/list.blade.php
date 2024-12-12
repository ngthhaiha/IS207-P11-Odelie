@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Image</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá tiền</th>
                <th>Active</th>
                <th>Update</th>
                <th>&nbsp;</th>
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $key => $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <img class="thumb" src="{{ $product['thumb'] }}" alt="">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{!! \App\Helpers\Helper::isActive($product->isActive) !!}</td>
                    <td>{{ $product->updated_at }}</td>
                    <td>
                        <a href="{{ url('admin/products/edit/' . $product->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                        <a href="#" class="btn btn-danger btn-sm action_delete" 
                        data-url="{{ url('admin/products/destroy/' . $product->id) }}">Xóa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
