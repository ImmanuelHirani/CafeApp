        <!-- Login & register Box -->
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
                            class="w-full h-12 border-b-[1px] border-white bg-transparent outline-none"
                            placeholder="Username / Email" />
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
                        <svg class="absolute right-0 w-6 h-6 bottom-2" fill="white" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12,4 C14.7275481,4 17.3356792,5.4306247 19.76629,7.78114976 C20.5955095,8.58304746 21.3456935,9.43915664 22.0060909,10.2956239 C22.4045936,10.8124408 22.687526,11.2189945 22.8424353,11.4612025 L23.1870348,12 L22.8424353,12.5387975 C22.687526,12.7810055 22.4045936,13.1875592 22.0060909,13.7043761 C21.3456935,14.5608434 20.5955095,15.4169525 19.76629,16.2188502 C17.3356792,18.5693753 14.7275481,20 12,20 C9.27245185,20 6.66432084,18.5693753 4.23371003,16.2188502 C3.40449054,15.4169525 2.65430652,14.5608434 1.99390911,13.7043761 C1.59540638,13.1875592 1.31247398,12.7810055 1.15756471,12.5387975 L0.812965202,12 L1.15756471,11.4612025 C1.31247398,11.2189945 1.59540638,10.8124408 1.99390911,10.2956239 C2.65430652,9.43915664 3.40449054,8.58304746 4.23371003,7.78114976 C6.66432084,5.4306247 9.27245185,4 12,4 Z M20.4222529,11.5168761 C19.8176112,10.7327184 19.1301624,9.94820254 18.37596,9.21885024 C16.2825083,7.1943753 14.1050769,6 12,6 C9.89492315,6 7.71749166,7.1943753 5.62403997,9.21885024 C4.86983759,9.94820254 4.18238879,10.7327184 3.57774714,11.5168761 C3.44715924,11.6862352 3.32648802,11.8478224 3.21616526,12 C3.32648802,12.1521776 3.44715924,12.3137648 3.57774714,12.4831239 C4.18238879,13.2672816 4.86983759,14.0517975 5.62403997,14.7811498 C7.71749166,16.8056247 9.89492315,18 12,18 C14.1050769,18 16.2825083,16.8056247 18.37596,14.7811498 C19.1301624,14.0517975 19.8176112,13.2672816 20.4222529,12.4831239 C20.5528408,12.3137648 20.673512,12.1521776 20.7838347,12 C20.673512,11.8478224 20.5528408,11.6862352 20.4222529,11.5168761 Z M12,16 C9.790861,16 8,14.209139 8,12 C8,9.790861 9.790861,8 12,8 C14.209139,8 16,9.790861 16,12 C16,14.209139 14.209139,16 12,16 Z M12,14 C13.1045695,14 14,13.1045695 14,12 C14,10.8954305 13.1045695,10 12,10 C10.8954305,10 10,10.8954305 10,12 C10,13.1045695 10.8954305,14 12,14 Z"
                                fill-rule="evenodd" />
                        </svg>
                    </div>
                    <button type="submit"
                        class="w-full py-3 mt-3 text-center rounded-lg bg-secondary-color">Login</button>
                    <p class="text-center">
                        Don't Have Account ?
                        <span id="RegisterBoxOpen" class="text-red-500 cursor-pointer">Sign Up</span>
                    </p>
                </form>
                <img src="{{ asset('asset/Bobba-login.png') }}" class="absolute w-[10%] bottom-0 right-0"
                    alt="" />
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
                            class="w-full h-12 border-b-[1px] border-white bg-transparent outline-none"
                            placeholder="Email" />
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
                        <svg class="absolute right-0 w-6 h-6 bottom-2" fill="white" stroke-width="1.5"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.1182 14.702L14 15.5C11.2183 14.1038 9.5 12.5 8.5 10L9.26995 5.8699L7.81452 2L4.0636 2C2.93605 2 2.04814 2.93178 2.21654 4.04668C2.63695 6.83 3.87653 11.8765 7.5 15.5C11.3052 19.3052 16.7857 20.9564 19.802 21.6127C20.9668 21.8662 22 20.9575 22 19.7655L22 16.1812L18.1182 14.702Z"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="relative">
                        <input required type="password" name="password"
                            class="w-full h-12 border-b-[1px] border-white bg-transparent outline-none"
                            placeholder="Password" />
                        <svg class="absolute right-0 w-6 h-6 bottom-2" fill="white" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12,4 C14.7275481,4 17.3356792,5.4306247 19.76629,7.78114976 C20.5955095,8.58304746 21.3456935,9.43915664 22.0060909,10.2956239 C22.4045936,10.8124408 22.687526,11.2189945 22.8424353,11.4612025 L23.1870348,12 L22.8424353,12.5387975 C22.687526,12.7810055 22.4045936,13.1875592 22.0060909,13.7043761 C21.3456935,14.5608434 20.5955095,15.4169525 19.76629,16.2188502 C17.3356792,18.5693753 14.7275481,20 12,20 C9.27245185,20 6.66432084,18.5693753 4.23371003,16.2188502 C3.40449054,15.4169525 2.65430652,14.5608434 1.99390911,13.7043761 C1.59540638,13.1875592 1.31247398,12.7810055 1.15756471,12.5387975 L0.812965202,12 L1.15756471,11.4612025 C1.31247398,11.2189945 1.59540638,10.8124408 1.99390911,10.2956239 C2.65430652,9.43915664 3.40449054,8.58304746 4.23371003,7.78114976 C6.66432084,5.4306247 9.27245185,4 12,4 Z M20.4222529,11.5168761 C19.8176112,10.7327184 19.1301624,9.94820254 18.37596,9.21885024 C16.2825083,7.1943753 14.1050769,6 12,6 C9.89492315,6 7.71749166,7.1943753 5.62403997,9.21885024 C4.86983759,9.94820254 4.18238879,10.7327184 3.57774714,11.5168761 C3.44715924,11.6862352 3.32648802,11.8478224 3.21616526,12 C3.32648802,12.1521776 3.44715924,12.3137648 3.57774714,12.4831239 C4.18238879,13.2672816 4.86983759,14.0517975 5.62403997,14.7811498 C7.71749166,16.8056247 9.89492315,18 12,18 C14.1050769,18 16.2825083,16.8056247 18.37596,14.7811498 C19.1301624,14.0517975 19.8176112,13.2672816 20.4222529,12.4831239 C20.5528408,12.3137648 20.673512,12.1521776 20.7838347,12 C20.673512,11.8478224 20.5528408,11.6862352 20.4222529,11.5168761 Z M12,16 C9.790861,16 8,14.209139 8,12 C8,9.790861 9.790861,8 12,8 C14.209139,8 16,9.790861 16,12 C16,14.209139 14.209139,16 12,16 Z M12,14 C13.1045695,14 14,13.1045695 14,12 C14,10.8954305 13.1045695,10 12,10 C10.8954305,10 10,10.8954305 10,12 C10,13.1045695 10.8954305,14 12,14 Z"
                                fill-rule="evenodd" />
                        </svg>
                    </div>
                    <button type="submit" class="w-full py-3 mt-3 rounded-lg bg-secondary-color">
                        Register
                    </button>
                    <p class="text-center">
                        Already Have Account?
                        <span id="LoginBoxOpen" class="text-red-500 cursor-pointer">Sign In</span>
                    </p>
                </form>
                <img src="{{ asset('asset/Bobba-login.png') }}" class="absolute w-[10%] bottom-0 right-0"
                    alt="" />
                <img src="{{ asset('asset/Coffe-Login.png') }}" class="absolute w-[8%] top-0 left-0"
                    alt="" />
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
