<!-- resources/views/customer/create.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer</title>
</head>

<body>

    <!-- Autentikasi Check -->
    @auth
        <h1>ID: {{ Auth::user()->customer_ID ?? 'No Username' }}</h1>
        <h1>Phone: {{ Auth::user()->phone ?? 'No Username' }}</h1>
        <h1>Password: {{ Auth::user()->password ?? 'No Username' }}</h1>
        <h1>Email: {{ Auth::user()->email ?? 'No Email' }}</h1>
        <h1>created_at: {{ Auth::user()->created_at ?? 'No Email' }}</h1>
    @endauth

    @guest
        <h1>No Customer Logged In</h1>
    @endguest

</body>

</html>
