<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Draggable.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- Add this in your <head> section -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <!-- Pastikan ini ada di bagian HEAD, sebelum script payment -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" /> -->
    @vite('resources/css/app.css')
</head>

<body>
    @include('layout.Navbar')
    <main>
        <section id="hero" class="relative flex items-center overflow-x-hidden">
            <div class="container flex flex-col-reverse items-center gap-6 mt-10 hero lg:my-20 lg:gap-0 lg:flex-row">
                <!-- Left Content -->
                <div
                    class="flex flex-col items-center w-full text-center gap-6 lg:gap-9 xl:w-[65%] lg:w-[60%] lg:items-start lg:text-start left-content">
                    <h1>Fusion Slice Delight Cafe</h1>
                    <h5 class="font-aesthetnova">
                        Enjoy high-quality, homemade cafe
                    </h5>
                    <div id="ExploreBtn"
                        class="relative inline-flex items-center justify-center gap-2 overflow-hidden rounded-md shadow-2xl backdrop-blur-2xl outline outline-1 outline-white w-fit">
                        <a href=""
                            class="px-6 py-2 text-lg font-medium rounded-lg 3xl:text-2xl md:px-12 md:py-3 md:text-xl font-aesthetnova">Explore
                            Now</a>
                    </div>
                </div>
                <!-- Right Content -->
                <div
                    class="flex items-center justify-center w-full xl:w-[35%] lg:w-[40%] md:w-[70%] rounded-full right-content-hero">
                    <img src="{{ asset('/asset/Pizza-Hero.png') }}" class="w-full" alt="Pizza Hero Image" />
                </div>
            </div>
            <video src="{{ asset('/asset/Pizza HD_2.mp4') }}" class="absolute inset-0 object-cover w-full h-full -z-10"
                loop autoplay muted></video>
            <div class="absolute w-full h-full bg-opacity-70 bg-primary-color overlay-bg -z-10"></div>
        </section>
        <section id="toppings" class="flex items-center overflow-x-hidden lg:h-screen">
            <div
                class="container flex flex-col items-center justify-center gap-6 md:gap-12 lg:gap-32 lg:flex-row toppings-content">
                <div class="left-content lg:w-[60%] w-full flex flex-col lg:gap-6 gap-3">
                    <h2>Unstoppable</h2>
                    <p class="text-5xl lg:text-7xl 2xl:text-9xl">
                        TOPPINGS
                    </p>
                    <h6 class="text-justify lg:ml-20">
                        Cheese pizza is, obviously, perfection. But we the
                        people, in order to form a more perfect pie, love
                        our toppings , Here The list of our avaliable
                        Toppings
                    </h6>
                </div>
                <div
                    class="flex lg:flex-row flex-col items-center md:gap-6 gap-3 mx-auto right-content lg:w-[40%] w-full">
                    <div
                        class="2xl:min-w-[500px] 2xl:h-[520px] md:min-w-[450px] md:h-[450px] w-full h-[300px] img-wrap overflow-hidden group relative">
                        <img src="{{ asset('/asset/Topping/Topping1.jpg') }}"
                            class="object-cover w-full h-full rounded-t-lg lg:rounded-none" alt="" />
                        <div
                            class="absolute flex items-center justify-center w-16 h-16 overflow-hidden transition-all duration-300 ease-in-out rounded-full bg-secondary-accent-color md:w-24 md:h-24 top-3 left-3 bg-opacity-70 box-number backdrop-blur-md">
                            <h3 class="items-start mt-1.5 md:mt-3">01</h3>
                        </div>
                        <div
                            class="absolute bottom-0 flex items-center justify-center w-full p-3 transition-all duration-300 ease-in-out translate-x-1/2 bg-secondary-accent-color backdrop-blur-md right-1/2 bg-opacity-70 topping-name">
                            <h6 class="text-center">Peperoni</h6>
                        </div>
                    </div>
                    <div
                        class="lg:flex grid grid-cols-2 flex-wrap items-center lg:gap-6 gap-3 md:min-w-[1000px] w-full">
                        <div
                            class="relative 2xl:min-w-[300px] lg:rounded-none rounded-t-lg 2xl:h-[250px] md:min-w-[150px] md:h-[215px] min-w-[150px] h-[139px] img-wrap group overflow-hidden">
                            <img src="{{ asset('/asset/Topping/Topping2.png') }}" class="object-cover w-full h-full"
                                alt="" />
                            <div
                                class="absolute flex items-center justify-center w-12 h-12 overflow-hidden transition-all duration-300 ease-in-out rounded-full bg-secondary-accent-color backdrop-blur-md md:w-16 md:h-16 top-3 left-3 bg-opacity-70 box-number">
                                <h5 class="items-start md:mt-3 mt-1.5">
                                    02
                                </h5>
                            </div>
                            <div
                                class="absolute bottom-0 flex items-center justify-center w-full p-2 transition-all duration-300 ease-in-out translate-x-1/2 bg-secondary-accent-color backdrop-blur-md right-1/2 bg-opacity-70 h-fit topping-name">
                                <h6 class="text-center">Mushroom</h6>
                            </div>
                        </div>
                        <div
                            class="relative 2xl:min-w-[300px] lg:rounded-none rounded-t-lg 2xl:h-[250px] md:min-w-[150px] md:h-[215px] min-w-[150px] h-[139px] img-wrap group overflow-hidden">
                            <img src="{{ asset('/asset/Topping/Topping3.png') }}" class="object-cover w-full h-full"
                                alt="" />
                            <div
                                class="absolute flex items-center justify-center w-12 h-12 overflow-hidden transition-all duration-300 ease-in-out rounded-full bg-secondary-accent-color backdrop-blur-md md:w-16 md:h-16 top-3 left-3 bg-opacity-70 box-number">
                                <h5 class="items-start md:mt-3 mt-1.5">
                                    03
                                </h5>
                            </div>
                            <div
                                class="absolute bottom-0 flex items-center justify-center w-full p-2 transition-all duration-300 ease-in-out translate-x-1/2 bg-secondary-accent-color backdrop-blur-md right-1/2 bg-opacity-70 h-fit topping-name">
                                <h6 class="text-center">Onion</h6>
                            </div>
                        </div>
                        <div
                            class="relative 2xl:min-w-[300px] lg:rounded-none rounded-t-lg 2xl:h-[250px] md:min-w-[150px] md:h-[215px] min-w-[150px] h-[139px] img-wrap group overflow-hidden">
                            <img src="{{ asset('/asset/Topping/Topping4.png') }}" class="object-cover w-full h-full"
                                alt="" />
                            <div
                                class="absolute flex items-center justify-center w-12 h-12 overflow-hidden transition-all duration-300 ease-in-out rounded-full bg-secondary-accent-color backdrop-blur-md md:w-16 md:h-16 top-3 left-3 bg-opacity-70 box-number">
                                <h5 class="items-start md:mt-3 mt-1.5">
                                    04
                                </h5>
                            </div>
                            <div
                                class="absolute bottom-0 flex items-center justify-center w-full p-2 transition-all duration-300 ease-in-out translate-x-1/2 bg-secondary-accent-color backdrop-blur-md right-1/2 bg-opacity-70 h-fit topping-name">
                                <h6 class="text-center">Sausage</h6>
                            </div>
                        </div>
                        <div
                            class="relative 2xl:min-w-[300px] lg:rounded-none rounded-t-lg 2xl:h-[250px] md:min-w-[150px] md:h-[215px] min-w-[150px] h-[139px] img-wrap group overflow-hidden">
                            <img src="{{ asset('/asset/Topping/Topping5.png') }}" class="object-cover w-full h-full"
                                alt="" />
                            <div
                                class="absolute flex items-center justify-center w-12 h-12 overflow-hidden transition-all duration-300 ease-in-out rounded-full bg-secondary-accent-color backdrop-blur-md md:w-16 md:h-16 top-3 left-3 bg-opacity-70 box-number">
                                <h5 class="items-start md:mt-3 mt-1.5">
                                    05
                                </h5>
                            </div>
                            <div
                                class="absolute bottom-0 flex items-center justify-center w-full p-2 transition-all duration-300 ease-in-out translate-x-1/2 bg-secondary-accent-color backdrop-blur-md right-1/2 bg-opacity-70 h-fit topping-name">
                                <h6 class="text-center">Cheese</h6>
                            </div>
                        </div>
                        <div
                            class="relative 2xl:min-w-[300px] lg:rounded-none rounded-t-lg 2xl:h-[250px] md:min-w-[150px] md:h-[215px] min-w-[150px] h-[139px] img-wrap group overflow-hidden">
                            <img src="{{ asset('/asset/Topping/Topping6.png') }}" class="object-cover w-full h-full"
                                alt="" />
                            <div
                                class="absolute flex items-center justify-center w-12 h-12 overflow-hidden transition-all duration-300 ease-in-out rounded-full bg-secondary-accent-color backdrop-blur-md md:w-16 md:h-16 top-3 left-3 bg-opacity-70 box-number">
                                <h5 class="items-start md:mt-3 mt-1.5">
                                    06
                                </h5>
                            </div>
                            <div
                                class="absolute bottom-0 flex items-center justify-center w-full p-2 transition-all duration-300 ease-in-out translate-x-1/2 bg-secondary-accent-color backdrop-blur-md right-1/2 bg-opacity-70 h-fit topping-name">
                                <h6 class="text-center">Tomato</h6>
                            </div>
                        </div>
                        <div
                            class="relative 2xl:min-w-[300px] lg:rounded-none rounded-t-lg 2xl:h-[250px] md:min-w-[150px] md:h-[215px] min-w-[150px] h-[139px] img-wrap group overflow-hidden">
                            <img src="{{ asset('/asset/Topping/Topping5.png') }}" class="object-cover w-full h-full"
                                alt="" />
                            <div
                                class="absolute flex items-center justify-center w-12 h-12 overflow-hidden transition-all duration-300 ease-in-out rounded-full bg-secondary-accent-color backdrop-blur-md md:w-16 md:h-16 top-3 left-3 bg-opacity-70 box-number">
                                <h5 class="items-start md:mt-3 mt-1.5">
                                    07
                                </h5>
                            </div>
                            <div
                                class="absolute bottom-0 flex items-center justify-center w-full p-2 transition-all duration-300 ease-in-out translate-x-1/2 bg-secondary-accent-color backdrop-blur-md right-1/2 bg-opacity-70 h-fit topping-name">
                                <h6 class="text-center">Peperoni</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="custom-order" class="overflow-x-hidden secondary-color-gradient">
            <div class="flex flex-col gap-4 md:gap-12">
                <div class="pb-4 text-center title">
                    <h5>
                        But pizza-lovers weren't afraid to Custom Their Own
                        Pizza ingredients.
                    </h5>
                </div>
                <div class="w-full overflow-x-hidden swiper">
                    <div class="customTopping">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div
                                    class="relative overflow-hidden rounded-2xl scale-[0.9] opacity-50 topping-wrapper transition-all ease-in-out duration-500">
                                    <div class="content-topping">
                                        <img src="{{ asset('asset/Topping/Chocco.png') }}"
                                            class="object-cover w-full h-full transition-all duration-500 ease-in-out rounded-2xl image-topping"
                                            alt="" />
                                    </div>
                                    <div
                                        class="absolute w-12 h-12 p-3 transition-all duration-500 ease-in-out -translate-y-full bg-opacity-50 rounded-full opacity-0 md:w-16 md:h-16 top-2 topping-logo right-2 overlay-icon backdrop-blur-md bg-primary-color outline outline-2 outline-white">
                                        <img src="{{ asset('asset/Topping/choco - logo.png') }}" class="w-[100%]"
                                            alt="" />
                                    </div>
                                    <figcaption
                                        class="absolute bottom-0 translate-x-1/2 translate-y-full md:p-4 p-2.5 opacity-0 transition-all ease-in-out duration-500 rounded-b-2xl right-1/2 w-full text-center backdrop-blur-md overlay-content-title">
                                        <h6>Slime Choco</h6>
                                    </figcaption>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="relative overflow-hidden rounded-2xl scale-[0.9] opacity-50 topping-wrapper transition-all ease-in-out duration-500">
                                    <div class="content-topping">
                                        <img src="{{ asset('asset/Topping/jam.png') }}"
                                            class="object-cover w-full h-full transition-all duration-500 ease-in-out rounded-2xl image-topping"
                                            alt="" />
                                    </div>
                                    <div
                                        class="absolute w-12 h-12 p-3 transition-all duration-500 ease-in-out -translate-y-full bg-opacity-50 rounded-full opacity-0 md:w-16 md:h-16 top-2 topping-logo right-2 overlay-icon backdrop-blur-md bg-primary-color outline outline-2 outline-white">
                                        <img src="{{ asset('asset/Topping/jam - logo.png') }}" class="w-[100%]"
                                            alt="" />
                                    </div>
                                    <figcaption
                                        class="absolute bottom-0 translate-x-1/2 translate-y-full md:p-4 p-2.5 opacity-0 transition-all ease-in-out duration-500 rounded-b-2xl right-1/2 w-full text-center backdrop-blur-md overlay-content-title">
                                        <h6>Strawberry Jam</h6>
                                    </figcaption>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="relative overflow-hidden rounded-2xl scale-[0.9] opacity-50 topping-wrapper transition-all ease-in-out duration-500">
                                    <div class="content-topping">
                                        <img src="{{ asset('asset/Topping/Chocco.png') }}"
                                            class="object-cover w-full h-full transition-all duration-500 ease-in-out rounded-2xl image-topping"
                                            alt="" />
                                    </div>
                                    <div
                                        class="absolute w-12 h-12 p-3 transition-all duration-500 ease-in-out -translate-y-full bg-opacity-50 rounded-full opacity-0 md:w-16 md:h-16 top-2 topping-logo right-2 overlay-icon backdrop-blur-md bg-primary-color outline outline-2 outline-white">
                                        <img src="{{ asset('asset/Topping/choco - logo.png') }}" class="w-[100%]"
                                            alt="" />
                                    </div>
                                    <figcaption
                                        class="absolute bottom-0 translate-x-1/2 translate-y-full md:p-4 p-2.5 opacity-0 transition-all ease-in-out duration-500 rounded-b-2xl right-1/2 w-full text-center backdrop-blur-md overlay-content-title">
                                        <h6>Nuttela Chocolate</h6>
                                    </figcaption>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="relative overflow-hidden rounded-2xl scale-[0.9] opacity-50 topping-wrapper transition-all ease-in-out duration-500">
                                    <div class="content-topping">
                                        <img src="{{ asset('asset/Topping/Cheess.png') }}"
                                            class="object-cover w-full h-full transition-all duration-500 ease-in-out rounded-2xl image-topping"
                                            alt="" />
                                    </div>
                                    <div
                                        class="absolute w-12 h-12 p-3 transition-all duration-500 ease-in-out -translate-y-full bg-opacity-50 rounded-full opacity-0 md:w-16 md:h-16 top-2 topping-logo right-2 overlay-icon backdrop-blur-md bg-primary-color outline outline-2 outline-white">
                                        <img src="{{ asset('asset/Topping/chees - logo.png') }}" class="w-[100%]"
                                            alt="" />
                                    </div>
                                    <figcaption
                                        class="absolute bottom-0 translate-x-1/2 translate-y-full md:p-4 p-2.5 opacity-0 transition-all ease-in-out duration-500 rounded-b-2xl right-1/2 w-full text-center backdrop-blur-md overlay-content-title">
                                        <h6>Mozarella</h6>
                                    </figcaption>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="relative overflow-hidden rounded-2xl scale-[0.9] opacity-50 topping-wrapper transition-all ease-in-out duration-500">
                                    <div class="content-topping">
                                        <img src="{{ asset('asset/Topping/Chocco.png') }}"
                                            class="object-cover w-full h-full transition-all duration-500 ease-in-out rounded-2xl image-topping"
                                            alt="" />
                                    </div>
                                    <div
                                        class="absolute w-12 h-12 p-3 transition-all duration-500 ease-in-out -translate-y-full bg-opacity-50 rounded-full opacity-0 md:w-16 md:h-16 top-2 topping-logo right-2 overlay-icon backdrop-blur-md bg-primary-color outline outline-2 outline-white">
                                        <img src="{{ asset('asset/Topping/choco - logo.png') }}" class="w-[100%]"
                                            alt="" />
                                    </div>
                                    <figcaption
                                        class="absolute bottom-0 translate-x-1/2 translate-y-full md:p-4 p-2.5 opacity-0 transition-all ease-in-out duration-500 rounded-b-2xl right-1/2 w-full text-center backdrop-blur-md overlay-content-title">
                                        <h6>Slime Choco</h6>
                                    </figcaption>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="relative overflow-hidden rounded-2xl scale-[0.9] opacity-50 topping-wrapper transition-all ease-in-out duration-500">
                                    <div class="content-topping">
                                        <img src="{{ asset('asset/Topping/blueberry.png') }}"
                                            class="object-cover w-full h-full transition-all duration-500 ease-in-out rounded-2xl image-topping"
                                            alt="" />
                                    </div>
                                    <div
                                        class="absolute w-12 h-12 p-3 transition-all duration-500 ease-in-out -translate-y-full bg-opacity-50 rounded-full opacity-0 md:w-16 md:h-16 top-2 topping-logo right-2 overlay-icon backdrop-blur-md bg-primary-color outline outline-2 outline-white">
                                        <img src="{{ asset('asset/Topping/jam - logo.png') }}" class="w-[100%]"
                                            alt="" />
                                    </div>
                                    <figcaption
                                        class="absolute bottom-0 translate-x-1/2 translate-y-full md:p-4 p-2.5 opacity-0 transition-all ease-in-out duration-500 rounded-b-2xl right-1/2 w-full text-center backdrop-blur-md overlay-content-title">
                                        <h6>Blueberry Jam</h6>
                                    </figcaption>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="relative overflow-hidden rounded-2xl scale-[0.9] opacity-50 topping-wrapper transition-all ease-in-out duration-500">
                                    <div class="content-topping">
                                        <img src="{{ asset('asset/Topping/Chocco.png') }}"
                                            class="object-cover w-full h-full transition-all duration-500 ease-in-out rounded-2xl image-topping"
                                            alt="" />
                                    </div>
                                    <div
                                        class="absolute w-12 h-12 p-3 transition-all duration-500 ease-in-out -translate-y-full bg-opacity-50 rounded-full opacity-0 md:w-16 md:h-16 top-2 topping-logo right-2 overlay-icon backdrop-blur-md bg-primary-color outline outline-2 outline-white">
                                        <img src="{{ asset('asset/Topping/choco - logo.png') }}" class="w-[100%]"
                                            alt="" />
                                    </div>
                                    <figcaption
                                        class="absolute bottom-0 translate-x-1/2 translate-y-full md:p-4 p-2.5 opacity-0 transition-all ease-in-out duration-500 rounded-b-2xl right-1/2 w-full text-center backdrop-blur-md overlay-content-title">
                                        <h6>Nuttela Chocolate</h6>
                                    </figcaption>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="relative overflow-hidden rounded-2xl scale-[0.9] opacity-50 topping-wrapper transition-all ease-in-out duration-500">
                                    <div class="content-topping">
                                        <img src="{{ asset('asset/Topping/Cheess.png') }}"
                                            class="object-cover w-full h-full transition-all duration-500 ease-in-out rounded-2xl image-topping"
                                            alt="" />
                                    </div>
                                    <div
                                        class="absolute w-12 h-12 p-3 transition-all duration-500 ease-in-out -translate-y-full bg-opacity-50 rounded-full opacity-0 md:w-16 md:h-16 top-2 topping-logo right-2 overlay-icon backdrop-blur-md bg-primary-color outline outline-2 outline-white">
                                        <img src="{{ asset('asset/Topping/chees - logo.png') }}" class="w-[100%]"
                                            alt="" />
                                    </div>
                                    <figcaption
                                        class="absolute bottom-0 translate-x-1/2 translate-y-full md:p-4 p-2.5 opacity-0 transition-all ease-in-out duration-500 rounded-b-2xl right-1/2 w-full text-center backdrop-blur-md overlay-content-title">
                                        <h6>Mozarella</h6>
                                    </figcaption>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container relative flex items-center justify-between w-full mt-4 md:mt-0">
                    <div class="flex gap-4 swiper-custom-nav">
                        <svg id="prev" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42 42"
                            class="relative stroke-accent-color w-10 transition-all duration-300 ease-in-out 3xl:w-[11%] md:w-[10%] opacity-30 hover:opacity-100"
                            fill="none">
                            <rect x="0.5" y="0.5" width="41" height="41" rx="20.5" />
                            <path d="M28 21H14M14 21L18 17M14 21L18 25" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <svg id="next" xmlns="http://www.w3.org/2000/svg"
                            class="relative w-10 transition-all duration-300 stroke-accent-color ease-in-out 3xl:w-[11%] md:w-[10%] opacity-30 hover:opacity-100"
                            viewBox="0 0 42 42" fill="none">
                            <rect x="41.5" y="41.5" width="41" height="41" rx="20.5"
                                transform="rotate(-180 41.5 41.5)" />
                            <path d="M14 21L28 21M28 21L24 25M28 21L24 17" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div id="btn-custom"
                        class="relative inline-flex items-center justify-center overflow-hidden transition-all duration-500 ease-in-out rounded-full outline outline-1 hover:outline-none hover:bg-secondary-color backdrop-blur-lg md:outline-white md:bg-transparent bg-secondary-color md:w-[4em] h-[2.5em] md:hover:w-[14em] will-change-transform md:h-[4em]">
                        <a href="{{ Route('frontend.menu.custom') }}"
                            class="flex items-center w-full gap-2 px-4 py-2 overflow-hidden text-sm transition-all duration-500 ease-in-out rounded-lg md:hover:px-4 md:gap-4 group 3xl:text-2xl md:px-8 md:py-3 md:text-xl font-aesthetnova">
                            <i
                                class="self-center text-xl transition-all duration-500 ease-in-out md:-translate-x-1/2 md:text-3xl ti ti-pizza ti-pencil md:group-hover:translate-x-0"></i>
                            <div
                                class="text-sm font-medium transition-opacity duration-500 ease-in-out whitespace-nowrap md:text-2xl">
                                Custom Now
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section id="more-menu" class="overflow-x-hidden bg-secondary-accent-color">
            <div class="container">
                <div class="flex flex-col items-center gap-6 text-center xl:gap-12 headline-content">
                    <h2>Wait , There's More</h2>
                    <hr class="w-1/2" />
                    <h6 class="font-aesthetnova">
                        In this cafe, we serve more than just pizza. Enjoy
                        our rich coffee and refreshing bubble ice desserts,
                        adding a sweet touch to your day. Whether it's a
                        meal or a moment of relaxation, our menu brings
                        extra flavor to life's journey.
                    </h6>
                </div>
                <div class="flex flex-col gap-10 mt-6 lg:gap-20 lg:mt-20 main-content">
                    <div class="flex flex-col items-center grid-cols-2 gap-6 lg:grid md:gap-12 coffee">
                        <img src="{{ asset('asset/Coffe menu/Immanuel_Christian_Cappuccino_Coffee_f618a4a1-c4eb-4938-86d8-dde4681e8a1d.png') }}"
                            class="rounded-[20px] 3xl:w-[750px] xl:w-[536px] w-full 3xl:h-[450px] h-[347px] object-cover"
                            alt="" />
                        <div class="flex flex-col gap-6 md:gap-8 desc-content">
                            <h4>Capuccino Coffee</h4>
                            <p class="text-base text-justify md:text-2xl font-aesthetnova">
                                In this cup, a rich coffee with beautiful
                                latte art is served, bringing warmth and a
                                delightful aroma. This coffee is perfectly
                                brewed to offer an ideal moment of
                                relaxation, enhancing your day with an
                                elegant and satisfying indulgence.
                            </p>
                            <div id="coffe-menu"
                                class="relative moreMenu inline-flex items-center justify-center ms-auto overflow-hidden transition-all duration-500 ease-in-out rounded-full outline outline-1 hover:outline-none hover:bg-secondary-color backdrop-blur-lg md:outline-white md:bg-transparent bg-secondary-color w-fit md:w-[4em] h-[2.5em] md:hover:w-[21em] will-change-transform md:h-[4em]">
                                <a href="/menu#coffee"
                                    class="flex items-center w-full gap-2 px-6 py-3 overflow-hidden text-sm transition-all duration-500 ease-in-out rounded-lg jus md:gap-4 group 3xl:text-2xl md:px-8 md:py-3 md:text-xl font-aesthetnova">
                                    <i
                                        class="self-center text-xl transition-all duration-500 ease-in-out md:-translate-x-1/2 ti ti-coffee md:text-3xl md:group-hover:translate-x-0"></i>
                                    <div
                                        class="text-sm font-medium transition-opacity duration-500 ease-in-out md:opacity-0 whitespace-nowrap group-hover:opacity-100 md:text-2xl">
                                        See More Coffe Menu
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col-reverse items-center justify-between grid-cols-2 gap-6 md:gap-12 lg:grid bubble">
                        <div class="flex flex-col gap-6 md:gap-8 desc-content">
                            <h4>Melted Choco Bubble</h4>
                            <p class="text-base text-justify md:text-2xl font-aesthetnova">
                                This drink is a refreshing bubble ice,
                                featuring a sweet touch and the chewy
                                texture of enticing boba pearls. Cold and
                                delicious, it offers perfect refreshment,
                                adding enjoyment to every sip and
                                complementing your relaxing experience at
                                our café.
                            </p>
                            <div id="bubble-menu"
                                class="relative inline-flex moreMenu items-center justify-center overflow-hidden transition-all duration-500 ease-in-out rounded-full outline outline-1 hover:outline-none hover:bg-secondary-color backdrop-blur-lg md:outline-white md:bg-transparent bg-secondary-color md:w-[4em] w-fit h-[2.5em] md:hover:w-[22em] will-change-transform md:h-[4em]">
                                <a href="/menu#bubble"
                                    class="flex items-center w-full gap-2 px-6 py-2 overflow-hidden text-sm transition-all duration-500 ease-in-out rounded-lg md:gap-4 group 3xl:text-2xl md:px-8 md:py-3 md:text-xl font-aesthetnova">
                                    <i
                                        class="self-center text-xl transition-all duration-500 ease-in-out md:-translate-x-1/2 ti ti-bubble-tea md:text-3xl group-hover:translate-x-0"></i>

                                    <div
                                        class="text-sm font-medium transition-opacity duration-500 ease-in-out md:opacity-0 whitespace-nowrap md:group-hover:opacity-100 md:text-2xl">
                                        See more Bubble Menu
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="flex w-full place-content-end wrap">
                            <img src="{{ asset('asset/Booba Menu/image 30.png') }}"
                                class="rounded-[20px] 3xl:w-[750px] xl:w-[536px] w-full 3xl:h-[450px] h-[347px] object-cover"
                                alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- HTML -->
        <!-- Update your payment button and script -->
        <!-- Di bagian head -->
        @include('layout.popovers.aside.sidebar-frontend')
        @include('layout.modal.login-registerBox.Auth-Customer')
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
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<script src="{{ asset('/js/sidebar.js') }}"></script>

<script>
    checkoutBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const
    })
</script>

</html>
