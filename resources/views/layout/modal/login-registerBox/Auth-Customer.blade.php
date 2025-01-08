<div id="LoginRegisterBox"
    class="fixed inset-0 z-50 !text-white flex items-center justify-center invisible opacity-0 bg-secondary-accent-color bg-opacity-70 add-to-cart-quick-list font-aesthetnova">
    <div id="LoginBox"
        class="relative flex flex-col md:flex-row w-[90%] justify-center overflow-hidden md:w-[45%] h-[400px] md:h-[550px] p-4 md:p-8 gap-6 md:gap-9 rounded-lg bg-secondary-accent-color box-cart">
        <h5 class="absolute mt-3 text-gray-300 translate-x-1/2 lg:top-8 top-5 right-1/2">
            Login
        </h5>
        <form action="{{ route('login') }}" method="POST"
            class="flex flex-col justify-center lg:w-[90%] w-full col-span-3 gap-4">
            @csrf
            <div class="relative">
                <input required type="text" name="email" value="{{ old('email') }}"
                    class="w-full h-12 border-b-[1px] border-white bg-transparent outline-none" placeholder="Email" />
                <svg class="absolute right-0 w-6 h-6 bottom-2" fill="white" viewBox="0 0 48 48"
                    xmlns="http://www.w3.org/2000/svg">
                    <g data-name="8-Email" id="_8-Email">
                        <path
                            d="M45,7H3a3,3,0,0,0-3,3V38a3,3,0,0,0,3,3H45a3,3,0,0,0,3-3V10A3,3,0,0,0,45,7Zm-.64,2L24,24.74,3.64,9ZM2,37.59V10.26L17.41,22.17ZM3.41,39,19,23.41l4.38,3.39a1,1,0,0,0,1.22,0L29,23.41,44.59,39ZM46,37.59,30.59,22.17,46,10.26Z" />
                    </g>
                </svg>
            </div>
            <div class="relative">
                <input required type="password" name="password"
                    class="w-full h-12 border-b-[1px] border-white bg-transparent outline-none"
                    placeholder="Password" />
                <i class="absolute right-0 w-6 h-6 text-3xl cursor-pointer ti ti-eye bottom-3 trigger-reveal-pass"></i>
            </div>
            <button type="submit" class="w-full py-3 mt-3 text-center rounded-lg bg-secondary-color">Login</button>
            <p class="text-center">
                Don't Have Account ?
                <span id="RegisterBoxOpen" class="text-red-500 cursor-pointer">Sign Up</span>
            </p>
        </form>
        <img src="{{ asset('asset/Bobba-login.png') }}" class="absolute w-[10%] bottom-0 right-0" alt="" />
        <img src="{{ asset('asset/Coffe-Login.png') }}" class="absolute w-[8%] top-0 left-0" alt="" />
        <img src="{{ asset('asset/Pizza-Hero.png') }}"
            class="absolute translate-x-1/2 right-1/2 xl:w-fit w-[70%] lg:-bottom-[53%] -bottom-[60%]" alt="" />
        <!-- Close Button -->
        <svg xmlns="http://www.w3.org/2000/svg"
            class="absolute cursor-pointer closeloginBox lg:top-6 top-3 lg:right-6 right-3" width="20"
            height="20" viewBox="0 0 12 12" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M0.29289 0.29289C0.68342 -0.09763 1.31658 -0.09763 1.70711 0.29289L6 4.58579L10.2929 0.29289C10.6834 -0.09763 11.3166 -0.09763 11.7071 0.29289C12.0976 0.68342 12.0976 1.31658 11.7071 1.70711L7.4142 6L11.7071 10.2929C12.0976 10.6834 12.0976 11.3166 11.7071 11.7071C11.3166 12.0976 10.6834 12.0976 10.2929 11.7071L6 7.4142L1.70711 11.7071C1.31658 12.0976 0.68342 12.0976 0.29289 11.7071C-0.09763 11.3166 -0.09763 10.6834 0.29289 10.2929L4.58579 6L0.29289 1.70711C-0.09763 1.31658 -0.09763 0.68342 0.29289 0.29289Z"
                fill="white" />
        </svg>
    </div>
    <div id="RegisterBox"
        class="flex flex-col absolute opacity-0 bottom-1/2 invisible translate-y-1/2 md:flex-row w-[90%] justify-center overflow-hidden md:w-[45%] h-[400px] md:h-[550px] p-4 md:p-8 gap-6 md:gap-9 rounded-lg bg-secondary-accent-color box-cart">
        <h5 class="absolute mt-3 text-gray-300 translate-x-1/2 lg:top-8 top-3 right-1/2">
            Register
        </h5>
        <form action="{{ route('register') }}" method="POST"
            class="flex flex-col justify-center lg:w-[90%] w-full col-span-3 gap-4">
            @csrf
            <div class="relative">
                <input required type="text" name="email" value="{{ old('email') }}"
                    class="w-full h-12 border-b-[1px] border-white bg-transparent outline-none" placeholder="Email" />
                <svg class="absolute right-0 w-6 h-6 bottom-2" fill="white" viewBox="0 0 48 48"
                    xmlns="http://www.w3.org/2000/svg">
                    <g data-name="8-Email" id="_8-Email">
                        <path
                            d="M45,7H3a3,3,0,0,0-3,3V38a3,3,0,0,0,3,3H45a3,3,0,0,0,3-3V10A3,3,0,0,0,45,7Zm-.64,2L24,24.74,3.64,9ZM2,37.59V10.26L17.41,22.17ZM3.41,39,19,23.41l4.38,3.39a1,1,0,0,0,1.22,0L29,23.41,44.59,39ZM46,37.59,30.59,22.17,46,10.26Z" />
                    </g>
                </svg>
            </div>
            <div class="relative">
                <input required type="text" name="phone" value="{{ old('phone') }}"
                    class="w-full h-12 border-b-[1px]
                            border-white bg-transparent outline-none"
                    placeholder="Phone Number" />
                <svg class="absolute right-0 w-6 h-6 bottom-2" fill="white" stroke-width="1.5" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18.1182 14.702L14 15.5C11.2183 14.1038 9.5 12.5 8.5 10L9.26995 5.8699L7.81452 2L4.0636 2C2.93605 2 2.04814 2.93178 2.21654 4.04668C2.63695 6.83 3.87653 11.8765 7.5 15.5C11.3052 19.3052 16.7857 20.9564 19.802 21.6127C20.9668 21.8662 22 20.9575 22 19.7655L22 16.1812L18.1182 14.702Z"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="relative">
                <input required type="password" name="password"
                    class="w-full h-12 border-b-[1px] border-white bg-transparent outline-none"
                    placeholder="Password" />
                <i class="absolute right-0 w-6 h-6 text-3xl cursor-pointer ti ti-eye bottom-3 trigger-reveal-pass"></i>
            </div>
            <button type="submit" class="w-full py-3 mt-3 rounded-lg bg-secondary-color">
                Register
            </button>
            <p class="text-center">
                Already Have Account?
                <span id="LoginBoxOpen" class="text-red-500 cursor-pointer">Sign In</span>
            </p>
        </form>
        <img src="{{ asset('asset/Bobba-login.png') }}" class="absolute w-[10%] bottom-0 right-0" alt="" />
        <img src="{{ asset('asset/Coffe-Login.png') }}" class="absolute w-[8%] top-0 left-0" alt="" />
        <img src="{{ asset('asset/Pizza-Hero.png') }}"
            class="absolute translate-x-1/2 right-1/2 xl:w-fit w-[70%] lg:-bottom-[53%] -bottom-[60%]"
            alt="" />
        <!-- Close Button -->
        <svg xmlns="http://www.w3.org/2000/svg"
            class="absolute cursor-pointer closeloginBox lg:top-6 top-3 lg:right-6 right-3" width="20"
            height="20" viewBox="0 0 12 12" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M0.29289 0.29289C0.68342 -0.09763 1.31658 -0.09763 1.70711 0.29289L6 4.58579L10.2929 0.29289C10.6834 -0.09763 11.3166 -0.09763 11.7071 0.29289C12.0976 0.68342 12.0976 1.31658 11.7071 1.70711L7.4142 6L11.7071 10.2929C12.0976 10.6834 12.0976 11.3166 11.7071 11.7071C11.3166 12.0976 10.6834 12.0976 10.2929 11.7071L6 7.4142L1.70711 11.7071C1.31658 12.0976 0.68342 12.0976 0.29289 11.7071C-0.09763 11.3166 -0.09763 10.6834 0.29289 10.2929L4.58579 6L0.29289 1.70711C-0.09763 1.31658 -0.09763 0.68342 0.29289 0.29289Z"
                fill="white" />
        </svg>
    </div>
</div>
<script src="{{ asset('/js/boxLogin.js') }}"></script>
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
