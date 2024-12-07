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
                                                        alt="{{ $menu->name }}"
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
                                                            {{-- Menampilkan harga berdasarkan ukuran 'sm' --}}
                                                            @php
                                                                // Mencari property dengan size 'sm'
                                                                $property = $menu->properties->firstWhere('size', 'sm');
                                                            @endphp
                                                            @if ($property)
                                                                <p class="text-xl md:text-2xl">
                                                                    Rp
                                                                    {{ number_format($property->price, 0, ',', '.') }}
                                                                </p>
                                                            @else
                                                                <p class="text-xl md:text-2xl">Price Not Available</p>
                                                            @endif
                                                            <div class="flex items-center md:gap-2 gap-1.5 wrap">
                                                                <a href="{{ Route('frontend.menu.details', $menu->menu_ID ?? '') }}"
                                                                    class="px-6 py-1 text-lg rounded-lg md:px-8 md:py-1.5 bg-secondary-color">Details</a>
                                                                <a
                                                                    class="px-2 h-[2.5rem] flex items-center text-base rounded-lg cursor-pointer md:px-3 outline outline-2 outline-secondary-color transition-all ease-in-out duration-500 hover:bg-secondary-color">
                                                                    <i class="text-2xl ti ti-heart-filled"></i>
                                                                </a>
                                                            </div>
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
                                                                    class="px-2 h-[2.5rem] flex items-center text-base rounded-lg cursor-pointer md:px-3  outline outline-2 outline-secondary-color  transition-all ease-in-out duration-500 hover:bg-secondary-color">
                                                                    <i class="text-2xl ti ti-heart-filled"></i>
                                                                </a>
                                                            </div>
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
                                                                    class="px-2 h-[2.5rem] flex items-center text-base rounded-lg cursor-pointer md:px-3  outline outline-2 outline-secondary-color  transition-all ease-in-out duration-500 hover:bg-secondary-color">
                                                                    <i class="text-2xl ti ti-heart-filled"></i>
                                                                </a>
                                                            </div>
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
<script src="{{ asset('/js/boxLogin.js') }}"></script>

</html>
