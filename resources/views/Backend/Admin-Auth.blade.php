<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <!-- jQuery dan DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    @vite('resources/css/app.css')
</head>

<body id="Admin">
    <main class="grid w-full grid-cols-12 overflow-hidden bg-white rounded-lg h-fit">
        <div class="relative w-full h-full col-span-7 ">
            <img class="object-cover w-full h-full" src="{{ asset('asset/backgorund-AdminAuth.png') }}" alt="">
            <img class="absolute top-4 left-4" src="{{ asset('asset/Logo/Logo.png') }}" alt="">
            <div
                class="absolute flex flex-col items-center justify-center gap-1 translate-x-1/2 right-1/2 bottom-[55%]">
                <label class="!text-white text-5xl font-semibold">Welcome</label>
                <label class="!text-white text-lg">Login / Register See Dashboard</label>
            </div>
        </div>
        <div class="relative flex justify-center w-full h-full col-span-5">
            <form id="LoginBox" action="{{ route('login.admin') }}" method="POST"
                class="flex flex-col justify-center absolute 3xl:bottom-[40%] md:bottom-[35%]  lg:w-[90%] w-full col-span-3 gap-4">
                @csrf
                <h5 class="mb-4 font-semibold text-center font-aesthetnova">Login</h5>
                <div class="relative">
                    <input required type="text" name="email" value="{{ old('email') }}"
                        class="w-full h-12 p-3 bg-transparent border-2 border-gray-300 rounded-lg outline-none "
                        placeholder="Email" />
                    <i class="absolute w-6 h-6 text-3xl text-gray-400 ti ti-mail right-3 bottom-4"></i>

                </div>
                <div class="relative">
                    <input required type="password" name="password"
                        class="w-full h-12 p-3 bg-transparent border-2 border-gray-300 rounded-lg outline-none"
                        placeholder="Password" />
                    <i
                        class="absolute w-6 h-6 text-3xl text-gray-400 cursor-pointer right-3 ti ti-eye bottom-4 trigger-reveal-pass"></i>
                </div>
                <button type="submit"
                    class="w-full py-3 mt-3 font-semibold text-center rounded-lg bg-secondary-accent-color">Login</button>
                <p class="text-center">
                    Don't Have Account ?
                    <span id="RegisterBoxOpen" class="text-gray-500 underline cursor-pointer">Sign Up</span>
                </p>
            </form>
            <form id="RegisterBox" action="{{ route('register.admin') }}" method="POST"
                class="flex flex-col justify-center absolute 3xl:bottom-[40%] md:bottom-[35%] lg:w-[90%] w-full col-span-3 gap-4">
                @csrf
                <h5 class="mb-4 font-semibold text-center font-aesthetnova">Register</h5>
                <div class="relative">
                    <input required type="text" name="email" value="{{ old('email') }}"
                        class="w-full h-12 p-3 bg-transparent border-2 border-gray-300 rounded-lg outline-none "
                        placeholder="Email" />
                    <i class="absolute w-6 h-6 text-3xl text-gray-400 ti ti-mail right-3 bottom-4"></i>
                </div>
                <div class="relative">
                    <input required type="text" name="phone"
                        class="w-full h-12 p-3 bg-transparent border-2 border-gray-300 rounded-lg outline-none"
                        placeholder="Phone Number" />
                    <i class="absolute w-6 h-6 text-3xl text-gray-400 ti ti-phone right-3 bottom-4 "></i>
                </div>
                <div class="relative">
                    <input required type="password" name="password"
                        class="w-full h-12 p-3 bg-transparent border-2 border-gray-300 rounded-lg outline-none"
                        placeholder="Password" />
                    <i
                        class="absolute w-6 h-6 text-3xl text-gray-400 cursor-pointer right-3 ti ti-eye bottom-4 trigger-reveal-pass"></i>
                </div>
                <select name="user_type"
                    class="relative p-3 bg-white border-2 border-gray-300 rounded-lg outline-none text-secondary-accent-color">
                    <option value="">--Select Role--</option>
                    <option value="admin">Admin</option>
                    <option value="owner">Owner</option>
                </select>
                <button type="submit"
                    class="w-full py-3 font-semibold text-center rounded-lg bg-secondary-accent-color">Register</button>
                <p class="text-center">
                    Already Have Account ?
                    <span id="LoginBoxOpen" class="text-gray-500 underline cursor-pointer">Sign In</span>
                </p>
            </form>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script>
    // Create an instance of Notyf
    const notyf = new Notyf({
        duration: 1000,
        position: {
            x: 'right',
            y: 'top',
        },
        types: [{
                type: 'warning',
                background: 'orange',
                color: 'white', // Set text color to white
                icon: {
                    className: 'material-icons',
                    tagName: 'i',
                    text: 'warning',
                },
            },
            {
                type: 'success',
                background: '#2ECC71',

                dismissible: true,
                color: 'white', // Set text color to white
            },
            {
                type: 'error',
                background: 'indianred',
                dismissible: true,
                color: 'white', // Set text color to white
            },
        ],
    });

    // Display error notifications if there are any
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            notyf.error("{{ $error }}");
        @endforeach
    @endif

    @if (session('error'))
        notyf.error("{{ session('error') }}");
    @endif

    // Display a success notification if there is a success message in the session
    @if (session('success'))
        notyf.success("{{ session('success') }}");
    @endif
</script>
<script>
    const
        LoginBox = document.getElementById("LoginBox"),
        RegisterBox = document.getElementById("RegisterBox"),
        RegisterBoxOpen = document.getElementById("RegisterBoxOpen"),
        LoginBoxOpen = document.getElementById("LoginBoxOpen");

    RegisterBox.classList.add('hidden')

    RegisterBoxOpen.addEventListener("click", () => {
        RegisterBox.classList.remove("hidden");
        LoginBox.classList.add("hidden");
    });

    LoginBoxOpen.addEventListener("click", () => {
        // Menghapus class 'hidden' pada form LoginBox dan RegisterBox
        RegisterBox.classList.add("hidden");
        LoginBox.classList.remove("hidden");
    });
</script>
<script>
    // Menangkap semua elemen dengan kelas trigger-reveal-pass
    const revealPassIcons = document.querySelectorAll('.trigger-reveal-pass');

    revealPassIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            // Menemukan input password terkait dengan ikon yang diklik
            const passwordInput = icon.previousElementSibling;

            // Cek tipe input, jika password ganti menjadi text, sebaliknya ganti kembali menjadi password
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    });
</script>


</html>
