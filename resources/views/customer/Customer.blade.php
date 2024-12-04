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

    <h5>Hello {{ $data->email ?? 'No Email Was Found' }}</h5>
    <p>Phone: {{ $data->phone ?? 'No Phone Number Was found' }}</p>

    <form action="{{ route('register') }}" style="margin: 20px" method="POST">
        @csrf
        <div class="relative">
            <input required type="email" name="email"
                class="w-full h-12 border-0 border-white border-b-[1px] bg-transparent outline-none"
                value="{{ old('email') }}" placeholder="Email" />
        </div>
        <div class="relative">
            <input required type="text" name="phone"
                class="w-full h-12 border-0 border-white border-b-[1px] bg-transparent outline-none"
                value="{{ old('phone') }}" placeholder="Phone Number" />
        </div>
        <div class="relative">
            <input required type="password" name="password"
                class="w-full h-12 border-0 border-white border-b-[1px] bg-transparent outline-none"
                placeholder="Password" />
        </div>
        <button type="submit" class="w-full py-3 mt-3 rounded-lg bg-secondary-color">
            Register
        </button>
    </form>

    <!-- resources/views/customer/login.blade.php -->
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>

    <!-- Tampilkan error jika ada -->
    @if ($errors->any())
        <div class="errors">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</body>

</html>
