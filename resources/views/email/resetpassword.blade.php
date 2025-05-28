<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Your Password</h2>

    @if(session('message'))
        <p style="color:green">{{ session('message') }}</p>
    @endif

    <form method="POST" action="{{ url('/api/reset-password') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <label>New Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="password_confirmation" required><br><br>

        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
