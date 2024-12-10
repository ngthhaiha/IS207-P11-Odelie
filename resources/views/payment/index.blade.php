<!DOCTYPE html>
<html>
<head>
    <title>Trang Thanh Toán</title>
</head>
<body>
    <h1>Trang Thanh Toán</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <form method="POST" action="{{ route('payment.process') }}">
        @csrf
        <label for="amount">Số tiền:</label>
        <input type="number" id="amount" name="amount" required>
        <button type="submit">Thanh Toán</button>
    </form>
</body>
</html>
