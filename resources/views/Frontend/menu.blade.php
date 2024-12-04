<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" /> -->
    @vite('resources/css/app.css')
</head>

<body>
    @include('layout.Navbar')
    <main>
        <section class="relative flex overflow-hidden 2xl:h-screen xl:h-svh hero">
            <div class="container">
                <div class="md:w-[60%] w-full wrap 3xl:mt-48 xl:mt-36 mt-[74px]">
                    <h1>Menu</h1>
                    <h6>
                        Savor La Crema's delicious Menu with Mediterranean-style food
                        and drinks in the heart of Malta, including pizzas, pasta,
                        pastries, and coffee.
                    </h6>
                </div>
            </div>
            <div class="absolute inset-0 w-full h-full md:inset-px bg-menu -z-10">
                <img src="{{ asset('/asset/Background-menu.png') }}"
                    class="object-cover w-full h-full md:w-fit md:h-fit" alt="" />
            </div>
        </section>
        <section class="" id="all-menu">
            <div class="grid grid-cols-12">
                <div class="hidden col-span-2 row-end-2 md:block">
                    <div class="sticky flex flex-col items-center top-32 wrap gap-14">
                        <!-- Pizza  -->
                        <a href="#pizza">
                            <img src="{{ asset('/asset/SVG/Pizza-icon-QuickMenu.SVG') }}" alt="">
                        </a>
                        <!-- Pizza End -->

                        <!-- Bubble -->
                        <a href="#bubble">
                            <img src="{{ asset('/asset/SVG/Bubble-icon-QuickMenu.SVG') }}" alt="">
                        </a>
                        <!-- Bubble End -->

                        <!-- Coffee -->
                        <a href="#coffee">
                            <img src="{{ asset('/asset/SVG/Coffee-icon-QuickMenu.SVG') }}" alt="">
                        </a>
                        <!-- Coffee End -->
                    </div>
                </div>
                <!-- Menu -->
                <div class="flex flex-col col-span-12 gap-24 px-4 md:px-0 md:col-span-10 wrapping-menu">
                    <div class="w-full">
                        <div id="pizza" class="invisible relative -top-[75px]"></div>
                        <h2 class="mb-4 md:mb-12 text-start">Pizza</h2>
                        <div class="swiper">
                            <div class="3xl:pr-[95px] 2xl:pr-20 xl:pr-10 pizza-swiper">
                                <div class="swiper-wrapper">
                                    <!-- Card Menu -->
                                    @foreach ($menus as $menu)
                                        @if ($menu->menu_type == 'pizza' && $menu->is_active == 1)
                                            <div class="swiper-slide">
                                                <div
                                                    class="relative transition-all duration-300 ease-in-out scale-95 opacity-50 card-wrapper rounded-2xl h-fit bg-secondary-accent-color">
                                                    <img src="{{ asset('storage/' . $menu->image) }}"
                                                        alt="{{ $menu->name }} "
                                                        class="h-[250px] w-full text-white rounded-t-2xl object-cover object-center" />
                                                    <div class="flex flex-col gap-4 p-5 content">
                                                        <div class="flex flex-col gap-2 wrap-desc">
                                                            <h6 class="line-clamp-1">
                                                                {{ $menu->name }}
                                                            </h6>
                                                            <p
                                                                class="text-base text-justify font-aesthetnova line-clamp-3">
                                                                {{ $menu->menu_description }}
                                                            </p>
                                                        </div>
                                                        <div class="flex items-center justify-between wrap-price">
                                                            <p class="text-xl md:text-2xl">
                                                                Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                                            </p>
                                                            <div class="flex items-center md:gap-2 gap-1.5 wrap">
                                                                <a href="{{ Route('frontend.menu.details', $menu->menu_ID ?? '') }}"
                                                                    class="px-6 py-1 text-lg rounded-lg md:px-8 md:py-1.5 bg-secondary-color">Details</a>
                                                                <a
                                                                    class="px-2 py-[8px] text-base rounded-lg cursor-pointer md:px-4 md:py-[9px] bg-secondary-color trigger-menu-open">
                                                                    <img src="{{ asset('/asset/SVG/Cart-menu-icon.SVG') }}"
                                                                        alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="absolute fav top-4 right-6">
                                                            <img src="{{ asset('/asset/SVG/Fav-icon.SVG') }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <!-- Card Menu End -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div id="bubble" class="invisible relative -top-[75px]"></div>
                        <h2 class="mb-4 md:mb-12 text-start">Bubble Ice</h2>
                        <div class="swiper">
                            <div class="3xl:pr-[95px] 2xl:pr-20 xl:pr-10 bubble-swiper">
                                <div class="swiper-wrapper">
                                    <!-- Card Menu -->
                                    @foreach ($menus as $menu)
                                        @if ($menu->menu_type == 'bobba' && $menu->is_active == 1)
                                            <div class="swiper-slide">
                                                <div
                                                    class="relative transition-all duration-300 ease-in-out scale-95 opacity-50 card-wrapper rounded-2xl h-fit bg-secondary-accent-color">
                                                    <img src="{{ asset('storage/' . $menu->image) }}"
                                                        alt="{{ $menu->name }} "
                                                        class="h-[250px] w-full text-white rounded-t-2xl object-cover object-center" />
                                                    <div class="flex flex-col gap-4 p-5 content">
                                                        <div class="flex flex-col gap-2 wrap-desc">
                                                            <h6 class="line-clamp-1">
                                                                {{ $menu->name }}
                                                            </h6>
                                                            <p
                                                                class="text-base text-justify font-aesthetnova line-clamp-3">
                                                                {{ $menu->menu_description }}
                                                            </p>
                                                        </div>
                                                        <div class="flex items-center justify-between wrap-price">
                                                            <p class="text-xl md:text-2xl">
                                                                Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                                            </p>
                                                            <div class="flex items-center md:gap-2 gap-1.5 wrap">
                                                                <a href="{{ Route('frontend.menu.details', $menu->menu_ID ?? '') }}"
                                                                    class="px-6 py-1 text-lg rounded-lg md:px-8 md:py-1.5 bg-secondary-color">Details</a>
                                                                <a
                                                                    class="px-2 py-[8px] text-base rounded-lg cursor-pointer md:px-4 md:py-[9px] bg-secondary-color trigger-menu-open">
                                                                    <img src="{{ asset('/asset/SVG/Cart-menu-icon.SVG') }}"
                                                                        alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="absolute fav top-4 right-6">
                                                            <img src="{{ asset('/asset/SVG/Fav-icon.SVG') }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <!-- Card Menu End -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div id="coffee" class="invisible relative -top-[75px]"></div>
                        <h2 class="mb-4 md:mb-12 text-start">Coffee</h2>
                        <div class="swiper">
                            <div class="3xl:pr-[95px] 2xl:pr-20 xl:pr-10 coffee-swiper">
                                <div class="swiper-wrapper">
                                    <!-- Card Menu -->
                                    @foreach ($menus as $menu)
                                        @if ($menu->menu_type == 'coffee')
                                            <div class="swiper-slide">
                                                <div
                                                    class="relative transition-all duration-300 ease-in-out scale-95 opacity-50 card-wrapper rounded-2xl h-fit bg-secondary-accent-color">
                                                    <img src="{{ asset('storage/' . $menu->image) }}"
                                                        alt="{{ $menu->name }} "
                                                        class="h-[250px] w-full text-white rounded-t-2xl object-cover object-center" />
                                                    <div class="flex flex-col gap-4 p-5 content">
                                                        <div class="flex flex-col gap-2 wrap-desc">
                                                            <h6 class="line-clamp-1">
                                                                {{ $menu->name }}
                                                            </h6>
                                                            <p
                                                                class="text-base text-justify font-aesthetnova line-clamp-3">
                                                                {{ $menu->menu_description }}
                                                            </p>
                                                        </div>
                                                        <div class="flex items-center justify-between wrap-price">
                                                            <p class="text-xl md:text-2xl">
                                                                Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                                            </p>
                                                            <div class="flex items-center md:gap-2 gap-1.5 wrap">
                                                                <a href="{{ Route('frontend.menu.details', $menu->menu_ID ?? '') }}"
                                                                    class="px-6 py-1 text-lg rounded-lg md:px-8 md:py-1.5 bg-secondary-color">Details</a>
                                                                <a
                                                                    class="px-2 py-[8px] text-base rounded-lg cursor-pointer md:px-4 md:py-[9px] bg-secondary-color trigger-menu-open">
                                                                    <img src="{{ asset('/asset/SVG/Cart-menu-icon.SVG') }}"
                                                                        alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="absolute fav top-4 right-6">
                                                            <img src="{{ asset('/asset/SVG/Fav-icon.SVG') }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <!-- Card Menu End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Menu End -->
            </div>

        </section>
        <div id="cartquickMenu"
            class="fixed inset-0 z-50 flex items-center justify-center invisible bg-black opacity-0 bg-opacity-70 add-to-cart-quick-list font-aesthetnova">
            <div
                class="relative flex flex-col md:flex-row w-[90%] md:w-[60%] h-fit md:h-[553px] p-4 md:p-8 gap-3 md:gap-9 rounded-lg bg-secondary-accent-color outline outline-1 outline-highlight-content box-cart">
                <img src="../asset/Booba Menu/Choco bobba.jpg"
                    class="w-full h-[180px] md:h-full object-cover rounded-lg" alt="Melted Choco Bubble Image" />
                <div class="flex flex-col w-full h-full gap-3 place-content-center menu-selection">
                    <p class="text-lg md:text-2xl">Melted Choco Bubble</p>
                    <p class="text-lg md:text-2xl">Rp 50.000</p>
                    <!-- Size Selection -->
                    <div class="flex flex-col gap-3">
                        <p class="text-lg md:text-2xl">Size :</p>
                        <div class="flex flex-wrap items-center gap-3 menu-selection-wrapper">
                            <button class="w-[21%] md:w-[22%] py-1.5 bg-secondary-color rounded-full">
                                XL
                            </button>
                            <button
                                class="w-[21%] md:w-[22%] py-1.5 outline outline-2 outline-white hover:bg-red-500 transition-all ease-in-out duration-500 rounded-full">
                                LG
                            </button>
                            <button
                                class="w-[21%] md:w-[22%] py-1.5 outline outline-2 outline-white hover:bg-red-500 transition-all ease-in-out duration-500 rounded-full">
                                MD
                            </button>
                            <button
                                class="w-[21%] md:w-[22%] py-1.5 outline outline-2 outline-white hover:bg-red-500 transition-all ease-in-out duration-500 rounded-full">
                                SM
                            </button>
                        </div>
                    </div>
                    <!-- Extra Selection -->
                    <div class="flex flex-col gap-3">
                        <p class="text-lg md:text-2xl">Extra :</p>
                        <div class="flex flex-wrap items-center gap-3 menu-selection-wrapper">
                            <p class="text-highlight-content">
                                No extra item for this product
                            </p>
                        </div>
                    </div>
                    <!-- Quantity Selection -->
                    <div class="flex flex-col gap-3">
                        <p class="text-lg md:text-2xl">Qty :</p>
                        <div class="flex items-center justify-between gap-1 rounded-lg add-to-cart">
                            <button class="w-fit px-3 2xl:px-4 py-2.5 bg-secondary-color rounded-lg">
                                <svg width="20px" height="24px" fill="white" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M417.4,224H94.6C77.7,224,64,238.3,64,256c0,17.7,13.7,32,30.6,32h322.8c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                </svg>
                            </button>
                            <button class="w-full px-2 py-3 text-sm rounded-lg 2xl:px-5 bg-secondary-color">
                                ADD TO CART (3)
                            </button>
                            <button class="w-fit px-3 2xl:px-4 py-2.5 bg-secondary-color rounded-lg">
                                <svg width="20px" height="24px" fill="white" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- Subtotal -->
                    <hr />
                    <div class="flex items-center justify-between">
                        <p class="text-xl">SUBTOTAL</p>
                        <p class="text-xl">Rp 500.000</p>
                    </div>
                </div>
                <!-- Close Button -->
                <svg id="closequickCart" xmlns="http://www.w3.org/2000/svg"
                    class="absolute cursor-pointer top-6 right-6" width="20" height="20" viewBox="0 0 12 12"
                    fill="none">
                    <path class="fill-highlight-content" fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.29289 0.29289C0.68342 -0.09763 1.31658 -0.09763 1.70711 0.29289L6 4.58579L10.2929 0.29289C10.6834 -0.09763 11.3166 -0.09763 11.7071 0.29289C12.0976 0.68342 12.0976 1.31658 11.7071 1.70711L7.4142 6L11.7071 10.2929C12.0976 10.6834 12.0976 11.3166 11.7071 11.7071C11.3166 12.0976 10.6834 12.0976 10.2929 11.7071L6 7.4142L1.70711 11.7071C1.31658 12.0976 0.68342 12.0976 0.29289 11.7071C-0.09763 11.3166 -0.09763 10.6834 0.29289 10.2929L4.58579 6L0.29289 1.70711C-0.09763 1.31658 -0.09763 0.68342 0.29289 0.29289Z"
                        fill="none" />
                </svg>
            </div>
        </div>
        <!-- SideBar  -->
        @include('layout.Sidebar')
        <!-- Login & register Box -->
        @include('layout.AuthCustomer')
    </main>
    @include('layout.Footer')
</body>
<!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
      AOS.init();
  </script> -->


<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="{{ asset('/js/swiper.js') }}"></script>
<script src="{{ asset('/js/GSAP.js') }}"></script>
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<script src="{{ asset('/js/sidebar.js') }}"></script>
<script>
    const triggermenuopen = document.querySelectorAll(".trigger-menu-open"),
        cartquickMenu = document.getElementById("cartquickMenu"),
        closequickCart = document.getElementById("closequickCart");

    triggermenuopen.forEach((triggerMenu) => {
        triggerMenu.addEventListener("click", () => {
            cartquickMenu.classList.add("quick-menu-active");
        });
    });

    closequickCart.addEventListener("click", () => {
        cartquickMenu.classList.remove("quick-menu-active");
    });
</script>
<script src="{{ asset('/js/boxLogin.js') }}"></script>

</html>
