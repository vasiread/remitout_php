<!DOCTYPE html>
<html>
<head>
    <title>Your Documents</title>
</head>
<body>
    <p>Hi {{ $name }},</p>
    <p>Your documents are ready. Click the link below to download them:</p>
    <p><a href="{{ $zipUrl }}" target="_blank">Download Documents</a></p>
    <p>Note: This link will expire in 2 hours.</p>
</body>
</html>
