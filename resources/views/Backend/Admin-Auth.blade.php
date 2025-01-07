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
    <main class="grid w-full grid-cols-12 overflow-hidden bg-white rounded-lg">
        <div class="w-full h-[43.5rem] relative col-span-7  ">
            <img class="object-cover w-full h-full " src="{{ asset('asset/backgorund-AdminAuth.png') }}" alt="">
            <img class="absolute top-4 left-4" src="{{ asset('asset/Logo/Logo.png') }}" alt="">
            <div
                class="absolute flex flex-col items-center justify-center gap-1 translate-x-1/2 translate-y-1/2 wrap right-1/2 bottom-1/2">
                <label class="!text-white text-5xl font-semibold">Welcome</label>
                <label class="!text-white text-lg">Login / Register See Dashboard</label>
            </div>
        </div>
        <div class="flex items-center justify-center w-full h-full col-span-5 ">
            <form id="LoginBox" action="{{ route('login.admin') }}" method="POST"
                class="flex flex-col justify-center  lg:w-[90%] w-full col-span-3 gap-4">
                @csrf
                <h5 class="mb-4 font-semibold text-center font-aesthetnova">Login</h5>
                <div class="relative">
                    <input required type="text" name="email" value="{{ old('email') }}"
                        class="w-full h-12 p-3 bg-transparent border-2 border-gray-300 rounded-lg outline-none "
                        placeholder="Email" />
                    <svg class="absolute w-6 h-6 right-3 bottom-3" fill="gray" viewBox="0 0 48 48"
                        xmlns="http://www.w3.org/2000/svg">
                        <g data-name="8-Email" id="_8-Email">
                            <path
                                d="
                M45,7H3a3,3,0,0,0-3,3V38a3,3,0,0,0,3,3H45a3,3,0,0,0,3-3V10A3,3,0,0,0,45,7Zm-.64,2L24,24.74,3.64,9ZM2,37.59V10.26L17.41,22.17ZM3.41,39,19,23.41l4.38,3.39a1,1,0,0,0,1.22,0L29,23.41,44.59,39ZM46,37.59,30.59,22.17,46,10.26Z" />
                        </g>
                    </svg>
                </div>
                <div class="relative">
                    <input required type="password" name="password"
                        class="w-full h-12 p-3 bg-transparent border-2 border-gray-300 rounded-lg outline-none"
                        placeholder="Password" />
                    <svg class="absolute w-6 h-6 right-3 bottom-3" fill="gray" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12,4 C14.7275481,4 17.3356792,5.4306247 19.76629,7.78114976 C20.5955095,8.58304746 21.3456935,9.43915664 22.0060909,10.2956239 C22.4045936,10.8124408 22.687526,11.2189945 22.8424353,11.4612025 L23.1870348,12 L22.8424353,12.5387975 C22.687526,12.7810055 22.4045936,13.1875592 22.0060909,13.7043761 C21.3456935,14.5608434 20.5955095,15.4169525 19.76629,16.2188502 C17.3356792,18.5693753 14.7275481,20 12,20 C9.27245185,20 6.66432084,18.5693753 4.23371003,16.2188502 C3.40449054,15.4169525 2.65430652,14.5608434 1.99390911,13.7043761 C1.59540638,13.1875592 1.31247398,12.7810055 1.15756471,12.5387975 L0.812965202,12 L1.15756471,11.4612025 C1.31247398,11.2189945 1.59540638,10.8124408 1.99390911,10.2956239 C2.65430652,9.43915664 3.40449054,8.58304746 4.23371003,7.78114976 C6.66432084,5.4306247 9.27245185,4 12,4 Z M20.4222529,11.5168761 C19.8176112,10.7327184 19.1301624,9.94820254 18.37596,9.21885024 C16.2825083,7.1943753 14.1050769,6 12,6 C9.89492315,6 7.71749166,7.1943753 5.62403997,9.21885024 C4.86983759,9.94820254 4.18238879,10.7327184 3.57774714,11.5168761 C3.44715924,11.6862352 3.32648802,11.8478224 3.21616526,12 C3.32648802,12.1521776 3.44715924,12.3137648 3.57774714,12.4831239 C4.18238879,13.2672816 4.86983759,14.0517975 5.62403997,14.7811498 C7.71749166,16.8056247 9.89492315,18 12,18 C14.1050769,18 16.2825083,16.8056247 18.37596,14.7811498 C19.1301624,14.0517975 19.8176112,13.2672816 20.4222529,12.4831239 C20.5528408,12.3137648 20.673512,12.1521776 20.7838347,12 C20.673512,11.8478224 20.5528408,11.6862352 20.4222529,11.5168761 Z M12,16 C9.790861,16 8,14.209139 8,12 C8,9.790861 9.790861,8 12,8 C14.209139,8 16,9.790861 16,12 C16,14.209139 14.209139,16 12,16 Z M12,14 C13.1045695,14 14,13.1045695 14,12 C14,10.8954305 13.1045695,10 12,10 C10.8954305,10 10,10.8954305 10,12 C10,13.1045695 10.8954305,14 12,14 Z"
                            fill-rule="evenodd" />
                    </svg>
                </div>
                <button type="submit"
                    class="w-full py-3 mt-3 font-semibold text-center rounded-lg bg-secondary-accent-color">Login</button>
                <p class="text-center">
                    Don't Have Account ?
                    <span id="RegisterBoxOpen" class="text-gray-500 underline cursor-pointer">Sign Up</span>
                </p>
            </form>
            <form id="RegisterBox" action="{{ route('register.admin') }}" method="POST"
                class="flex flex-col justify-center lg:w-[90%] w-full col-span-3 gap-4">
                @csrf
                <h5 class="mb-4 font-semibold text-center font-aesthetnova">Register</h5>
                <div class="relative">
                    <input required type="text" name="email" value="{{ old('email') }}"
                        class="w-full h-12 p-3 bg-transparent border-2 border-gray-300 rounded-lg outline-none "
                        placeholder="Email" />

                </div>
                <div class="relative">
                    <input required type="text" name="phone"
                        class="w-full h-12 p-3 bg-transparent border-2 border-gray-300 rounded-lg outline-none"
                        placeholder="Phone Number" />

                </div>
                <div class="relative">
                    <input required type="password" name="password"
                        class="w-full h-12 p-3 bg-transparent border-2 border-gray-300 rounded-lg outline-none"
                        placeholder="Password" />

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



</html>
