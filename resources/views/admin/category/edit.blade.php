@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="{{ url('/admin/category/edit/' . $category->id) }}" method="POST">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="category">Tên Danh Mục</label>
            <input type="text" name="name" value="{{ $category->name }}" class="form-control" placeholder="Nhập tên danh mục">
        </div>

        <div class="form-group">
            <label>Danh Mục</label>
            <select class="form-control" name="parent_id">
                <option value="0" {{ $category->parent_id == 0 ? 'selected' : '' }}>Danh Mục Cha</option>
                @foreach($categories as $categoryParent)
                <option value="{{ $categoryParent->id }}" {{ $category->parent_id == $categoryParent->id ? 'selected' : '' }}>
                    {{ $categoryParent->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Active</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" id="active" name="active" 
                {{ $category->isActive == 1 ? 'checked' : '' }}>
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" 
                {{ $category->isActive == 0 ? 'checked' : '' }}>
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập nhật Danh Mục</button>
    </div>
</form>

@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
