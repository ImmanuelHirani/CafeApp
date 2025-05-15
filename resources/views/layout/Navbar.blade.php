<header class="fixed inset-x-0 top-0 z-50 md:top-12">
    <nav class="container relative w-full py-5 transition-all duration-300 ease-linear md:bg-transparent md:py-0">
        <div id="main-nav" class="relative flex items-center justify-between w-full md:pl-4 md:pr-5 group">
            <div class="left-nav">
                <a class="flex items-center gap-1">
                    <img src="{{ asset('/asset/SVG/Pizza_logo-navbar.svg') }}" class="md:w-[30%] w-[23%]" alt="" />
                    <p class="mt-1.5 text-2xl lg:text-3xl font-magilo">
                        Cafe Travel
                    </p>
                </a>
            </div>
            <div class="box"></div>
            <div class="hidden translate-x-1/2 lg:absolute right-1/2 middle-nav font-magilo lg:block">
                <div class="flex items-center justify-center gap-16 2xl:gap-20 link-wrapper">
                    <a href="/" class="text-xl text-opacity-50 3xl:text-2xl">Home</a>
                    <a class="text-xl text-opacity-50 3xl:text-2xl" href="/menu">
                        Menu
                    </a>
                    <a class="text-xl text-opacity-50 3xl:text-2xl" href="/menu/custom">
                        Custom Pizza
                    </a>
                    <a class="text-xl text-opacity-50 3xl:text-2xl" href="/contact">
                        Contact
                    </a>
                </div>
            </div>
            <div class="right-nav">
                <div class="flex items-center gap-4 icon-wrap">
                    <div class="flex items-center gap-2 wrap">
                        <button id="cartTrigger" class="cursor-pointer">
                            <img src="{{ asset('/asset/SVG/Cart_add-navbar.svg') }}" class="w-11 md:w-14"
                                alt="Cart" />
                        </button>
                        @auth
                            <a href="/profile" class="cursor-pointer">
                                <img src="{{ asset('/asset/SVG/User_login_navbar.svg') }}" class="w-8 md:w-10"
                                    alt="Logout" />
                            </a>
                        @endauth
                        @guest
                            <button id="loginRegisterTrigger" class="cursor-pointer">
                                <img src="{{ asset('/asset/SVG/User_login_navbar.svg') }}" class="w-8 md:w-10"
                                    alt="" />
                            </button>
                        @endguest
                    </div>

                    <button id="navTrigger" class="flex items-center p-2 rounded-full xl:hidden bg-secondary-color">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 6l16 0" />
                            <path d="M4 12l16 0" />
                            <path d="M4 18l16 0" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div id="mobilenavExpand" class="h-0 px-3 overflow-hidden">
            <div class="flex flex-col gap-4 mt-5 link-wrapper">
                <a href="/" class="text-2xl">Home</a>
                <a class="text-2xl opacity-80" href="/menu">
                    Menu
                </a>
                <a class="text-2xl opacity-80" href="/menu/custom">
                    Custom Pizza
                </a>
                <a class="text-2xl opacity-80" href="/contact">
                    Contact
                </a>
            </div>
        </div>
    </nav>
</header>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script>
    const notyf = new Notyf({
        duration: 3000,
        position: {
            x: 'right',
            y: 'top',
        },
        types: [{
                type: 'warning',
                background: 'orange',
                icon: {
                    className: 'material-icons  flex item-center  !text-white',
                    tagName: 'i',
                    text: 'warning'
                }
            },
            {
                type: 'info',
                background: 'blue',
                icon: false
            }, {
                type: 'success',
                background: '#2ECC71',
                dismissible: true,
            },
            {
                type: 'error',
                background: 'indianred',
                dismissible: true,
            },
        ],
    });

    @if (session('error'))
        notyf.error("{{ session('error') }}");
    @endif

    @if (session('success'))
        notyf.success("{{ session('success') }}");
    @endif

    @if (session('warning'))
        notyf.open({
            type: 'warning',
            message: {{ session('warning') }},
        });
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            notyf.error("{{ $error }}");
        @endforeach
    @endif
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const links = document.querySelectorAll('.link-wrapper a'); // Semua link di navbar

        // Fungsi untuk memeriksa apakah URL link sama dengan URL saat ini
        links.forEach(link => {
            if (link.href === window.location.href) {
                // Tambahkan kelas untuk link yang aktif
                link.classList.remove('text-opacity-50');
                link.classList.add('text-opacity-100');
            } else {
                // Tambahkan kelas untuk link yang tidak aktif
                link.classList.remove('text-opacity-100');
                link.classList.add('text-opacity-50');
            }
        });
    });
</script>
