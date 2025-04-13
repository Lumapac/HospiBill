<!DOCTYPE html>
<html>

<head>
    <title>Your Account Credentials</title>
</head>

<body>
    <h2>Welcome to HospiBill!</h2>
    <p><strong>Email:</strong> {{ $tenant->email }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>
    <p><strong>Domain:</strong> http://{{ $domain }}:8000</p>
</body>

</html>