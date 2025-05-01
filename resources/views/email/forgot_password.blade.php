<!DOCTYPE html>
<html>

<head>
    <title>Your Login Details</title>
</head>

<body>
    <h2>Hello!</h2>
    <p>Here are your login details:</p>
    <ul>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>User ID:</strong> {{ $userId }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>
    <p>Thank you!</p>
</body>

</html>