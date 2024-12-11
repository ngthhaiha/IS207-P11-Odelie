$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url) {
    if (confirm('Bạn có chắc chắn muốn xóa không?')) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    $('#category-' + id).remove();
                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            }
        });
    }
}



