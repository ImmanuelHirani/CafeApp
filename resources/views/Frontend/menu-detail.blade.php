<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <section class="mt-12 md:mt-20 contact-us">
            <div class="container flex flex-col grid-cols-12 gap-2 md:gap-8 md:grid 2xl:gap-8">
                <div class="col-span-5">
                    <img src="{{ asset('storage/' . $menuDetails->image ?? '') }}"
                        class="{{ $menuDetails->image ?? '' ? 'object-cover' : 'object-cover' }}  w-full 3xl:h-[35rem] 2xl:h-[31rem] h-[21rem] rounded-lg"
                        alt="{{ $menuDetails->name ?? 'Default Image' }}"
                        onerror="this.onerror=null; this.src='{{ asset('asset/Error-Image.png') }}';" />
                </div>
                <div class="flex flex-col col-span-4 gap-4 font-aesthetnova ">
                    <span class="flex flex-col-reverse justify-between gap-3 md:gap-4 md:flex-col">
                        <div class="items-center gap-1.5 star md:flex hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                fill="none">
                                <path
                                    d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                    class="fill-highlight-content" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                fill="none">
                                <path
                                    d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                    class="fill-highlight-content" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                fill="none">
                                <path
                                    d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                    class="fill-highlight-content" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                fill="none">
                                <path
                                    d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                    fill="white" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                fill="none">
                                <path
                                    d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                    fill="white" />
                            </svg>
                            <p class="text-xs">(20)</p>
                        </div>
                        <p class="text-2xl md:text-4xl 3xl:text-5xl" class="py-1 line-clamp-1">
                            {{ $menuDetails->name ?? '' }}</p>
                    </span>
                    <span class="flex flex-row justify-between md:gap-4 md:flex-col">
                        <p class="w-full text-xl md:text-2xl">
                            Rp {{ number_format($selectedPrice, 0, ',', '.') }}
                        </p>
                        <div class="flex items-center justify-between w-full gap-3 md:justify-normal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="hidden md:block stroke-highlight-content"
                                width="48" height="48" viewBox="0 0 32 32" fill="none">
                                <path
                                    d="M22.94 9V22.6H13.28C13.2405 21.9864 12.9689 21.4108 12.5203 20.9902C12.0718 20.5696 11.4799 20.3355 10.865 20.3355C10.2501 20.3355 9.65824 20.5696 9.20969 20.9902C8.76113 21.4108 8.48951 21.9864 8.45 22.6H6V9H22.94Z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M30.9999 17.8V22.6H29.3899C29.3504 21.9864 29.0788 21.4108 28.6303 20.9902C28.1817 20.5696 27.5898 20.3355 26.9749 20.3355C26.36 20.3355 25.7682 20.5696 25.3196 20.9902C24.8711 21.4108 24.5994 21.9864 24.5599 22.6H22.9399V13H26.3099L30.9999 17.8Z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M30.9999 17.8V22.6H29.3899C29.3504 21.9864 29.0788 21.4108 28.6303 20.9902C28.1817 20.5696 27.5898 20.3355 26.9749 20.3355C26.36 20.3355 25.7682 20.5696 25.3196 20.9902C24.8711 21.4108 24.5994 21.9864 24.5599 22.6H22.9399V17.8H30.9999Z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M10.8599 25C12.1965 25 13.2799 23.9254 13.2799 22.6C13.2799 21.2745 12.1965 20.2 10.8599 20.2C9.52341 20.2 8.43994 21.2745 8.43994 22.6C8.43994 23.9254 9.52341 25 10.8599 25Z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M26.9698 25C28.3063 25 29.3898 23.9254 29.3898 22.6C29.3898 21.2745 28.3063 20.2 26.9698 20.2C25.6333 20.2 24.5498 21.2745 24.5498 22.6C24.5498 23.9254 25.6333 25 26.9698 25Z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M1 10.6H3.61" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M1 13.8H3.61" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M1 17H3.61" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="w-full text-sm md:text-lg md:text-start text-end text-highlight-content">
                                Tanggerang Karawaci Only
                            </p>
                        </div>
                    </span>
                    <span class="flex-col hidden gap-3 md:flex">
                        <h6>Size :</h6>
                        <div class="flex items-center gap-3 flex-nowrap menu-selection-wrapper">
                            @isset($menuDetails)
                                @foreach ($menuDetails->properties as $property)
                                    <a href="{{ route('frontend.menu.details', ['id' => $menuDetails->menu_ID, 'size' => $property->size]) }}"
                                        class="w-full px-3 py-3 uppercase rounded-full outline text-center outline-2 {{ $selectedProperty && $selectedProperty->size == $property->size ? 'bg-secondary-color outline-secondary-color' : 'outline-white hover:bg-secondary-color transition-all ease-in-out duration-300 hover:outline-none' }}">
                                        {{ $property->size }}
                                    </a>
                                @endforeach
                            @else
                                <p>No sizes available for this menu.</p>
                            @endisset
                        </div>
                    </span>
                    <p class="text-base text-justify md:text-lg line-clamp-3">
                        {{ $menuDetails->menu_description ?? '' }}
                    </p>
                    <hr />
                </div>
                {{-- Sidecart Quick Add --}}
                @include('layout.CartMenu')
                {{-- Sidecart Quick Add end --}}
                {{-- Review --}}
                <div class="flex flex-col col-span-9 gap-6 h-fit md:mt-12 font-aesthetnova">
                    <div
                        class="flex flex-col gap-3 md:gap-0 md:items-end md:justify-between md:flex-row product-overview">
                        <div class="flex flex-col gap-2 left-content">
                            <p class="text-2xl">Product Review</p>
                            <span class="flex items-center gap-6">
                                <h3>3.0</h3>
                                <div class="flex items-center gap-1.5 star">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                        fill="none">
                                        <path
                                            d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                            class="fill-highlight-content" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                        fill="none">
                                        <path
                                            d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                            class="fill-highlight-content" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                        fill="none">
                                        <path
                                            d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                            class="fill-highlight-content" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                        fill="none">
                                        <path
                                            d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                        fill="none">
                                        <path
                                            d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                            fill="white" />
                                    </svg>
                                </div>
                            </span>
                            <p class="text-base md:text-xl">Based on 89 reviews</p>
                        </div>
                        <div class="right-content">
                            <button id="reviewTrigger"
                                class="md:px-8 px-6 py-1.5 md:text-lg rounded-lg md:py-2 text-base bg-secondary-color">
                                Write Review
                            </button>
                        </div>
                    </div>
                    <hr />
                    <div class="flex flex-col grid-cols-12 gap-4 md:grid customers-review">
                        <p class="col-span-2 text-base">IMMANUEL HIRANI</p>
                        <div class="flex flex-col col-span-9 gap-3 review-comment">
                            <div class="flex items-center gap-1.5 star">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                    fill="none">
                                    <path
                                        d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                        class="fill-highlight-content" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                    fill="none">
                                    <path
                                        d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                        class="fill-highlight-content" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                    fill="none">
                                    <path
                                        d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                        class="fill-highlight-content" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                    fill="none">
                                    <path
                                        d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                        fill="white" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                    fill="none">
                                    <path
                                        d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                        fill="white" />
                                </svg>
                            </div>
                            <p class="text-justify line-clamp-4 text-[17px]">
                                I recently tried Sicilian Pizza, and it was fantastic. The
                                thick crust is soft inside and crispy outside, a refreshing
                                change from thin-crust pizzas. The simple toppings of rich
                                tomato sauce, caciocavallo cheese, and a hint of anchovy are
                                incredibly flavorful. The Palermo sfincione, with onions and
                                breadcrumbs, and the Catania version with varied toppings, add
                                unique twists. Baked at high temperatures, the texture is
                                perfectly crispy yet chewy. The square slices are great for
                                sharing. Sicilian Pizza is a must-try for anyone looking for
                                an authentic and satisfying pizza experience.
                            </p>
                        </div>
                        <p class="self-start col-span-1 text-xs md:self-center text-end text-highlight-content">
                            2 month ago
                        </p>
                    </div>
                    <hr />
                    <div class="flex flex-col grid-cols-12 gap-4 md:grid customers-review">
                        <p class="col-span-2 text-base">IMMANUEL HIRANI</p>
                        <div class="flex flex-col col-span-9 gap-3 review-comment">
                            <div class="flex items-center gap-1.5 star">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                    fill="none">
                                    <path
                                        d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                        class="fill-highlight-content" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                    fill="none">
                                    <path
                                        d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                        class="fill-highlight-content" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                    fill="none">
                                    <path
                                        d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                        class="fill-highlight-content" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                    fill="none">
                                    <path
                                        d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                        fill="white" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                    fill="none">
                                    <path
                                        d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                        fill="white" />
                                </svg>
                            </div>
                            <p class="text-justify line-clamp-4 text-[17px]">
                                I recently tried Sicilian Pizza, and it was fantastic. The
                                thick crust is soft inside and crispy outside, a refreshing
                                change from thin-crust pizzas. The simple toppings of rich
                                tomato sauce, caciocavallo cheese, and a hint of anchovy are
                                incredibly flavorful. The Palermo sfincione, with onions and
                                breadcrumbs, and the Catania version with varied toppings, add
                                unique twists. Baked at high temperatures, the texture is
                                perfectly crispy yet chewy. The square slices are great for
                                sharing. Sicilian Pizza is a must-try for anyone looking for
                                an authentic and satisfying pizza experience.
                            </p>
                        </div>
                        <p class="self-start col-span-1 text-xs md:self-center text-end text-highlight-content">
                            2 month ago
                        </p>
                    </div>
                    <hr />
                    <div class="flex items-center self-end md:gap-3 gap-1.5 wrap-button-next-prev">
                        <button
                            class="md:w-[52px] w-12 md:py-2.5 py-3 bg-secondary-color rounded-xl md:text-lg text-base text-balance">
                            1
                        </button>
                        <button
                            class="md:w-[52px] w-12 md:py-2.5 py-3 hover:bg-red-500 transition-all ease-in-out duration-500 rounded-xl md:text-lg text-balance text-base">
                            2
                        </button>
                        <button
                            class="md:w-[52px] w-12 md:py-2.5 py-3 hover:bg-red-500 transition-all ease-in-out duration-500 rounded-xl md:text-lg text-balance text-base">
                            3
                        </button>
                        <button
                            class="md:w-[52px] w-12 md:py-2.5 py-3 hover:bg-red-500 transition-all ease-in-out duration-500 rounded-xl md:text-lg text-balance text-base">
                            4
                        </button>
                        <button
                            class="md:w-[52px] w-12 md:py-2.5 py-3 hover:bg-red-500 transition-all ease-in-out duration-500 rounded-xl md:text-lg text-balance text-base">
                            5
                        </button>
                    </div>
                </div>
                {{-- Review End --}}
            </div>
        </section>
        @include('layout.CartMenuMobile')
        <!-- Review Box Wrapper -->
        @include('layout.modal.review-product')
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
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="{{ asset('/js/swiper.js') }}"></script>
<script src="{{ asset('/js/GSAP.js') }}"></script>
<script src="{{ asset('/js/sidebar.js') }}"></script>
<script src="{{ asset('/js/boxLogin.js') }}"></script>
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script>
    const reviewTrigger = document.getElementById("reviewTrigger"),
        reviewBox = document.getElementById("reviewBox"),
        closeReviwe = document.getElementById("closeReviwe");

    reviewTrigger.addEventListener("click", () => {
        reviewTrigger.classList.add("trigger-active-review");
        reviewBox.classList.add("box-active-review");
    });

    closeReviwe.addEventListener("click", () => {
        reviewTrigger.classList.remove("trigger-active-review");
        reviewBox.classList.remove("box-active-review");
    });
</script>
<script>
    const triggermenuMobile = document.getElementById("triggermenuMobile"),
        closecartMobile = document.getElementById("closecartMobile"),
        addtoCartMobile = document.getElementById("addtoCartMobile");

    triggermenuMobile.addEventListener("click", () => {
        addtoCartMobile.classList.add("cart-mobile-menu-active");
    });

    closecartMobile.addEventListener("click", () => {
        addtoCartMobile.classList.remove("cart-mobile-menu-active");
    });
</script>

</html>
