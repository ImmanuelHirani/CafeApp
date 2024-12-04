<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../public/output.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Draggable.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" /> -->
</head>

<body>
    <header class="fixed inset-x-0 top-0 z-50 md:top-12">
        <nav class="container relative w-full py-5 transition-all duration-300 ease-linear md:bg-transparent md:py-0">
            <div id="main-nav" class="relative flex items-center justify-between w-full md:pl-4 md:pr-5 group">
                <div class="left-nav">
                    <a class="flex items-center gap-1">
                        <img src="../asset/SVG/Pizza_logo-navbar.svg" class="md:w-[30%] w-[23%]" alt="" />
                        <p class="mt-1.5 text-2xl lg:text-3xl font-magilo">Cafe Travel</p>
                    </a>
                </div>
                <div class="box"></div>
                <div class="hidden translate-x-1/2 lg:absolute right-1/2 middle-nav font-magilo lg:block">
                    <div class="flex items-center justify-center gap-16 2xl:gap-20 link-wrapper">
                        <a href="index.html" class="text-xl 3xl:text-2xl">Home</a>
                        <a class="text-xl opacity-80 3xl:text-2xl" href="menu.html">
                            Menu
                        </a>
                        <a class="text-xl opacity-80 3xl:text-2xl" href="custom-pizza.html">
                            Custom Pizza
                        </a>
                        <a class="text-xl opacity-80 3xl:text-2xl" href="contact-us.html">
                            Contact
                        </a>
                    </div>
                </div>
                <div class="right-nav">
                    <div class="flex items-center gap-3.5 md:gap-3 icon-wrap">
                        <button id="cartTrigger">
                            <img src="../asset/SVG/Cart_add-navbar.svg" class="w-10 md:w-14" alt="" />
                        </button>
                        <button id="loginRegisterTrigger">
                            <img src="../asset/SVG/User_login_navbar.svg" class="w-8 md:w-10" alt="" />
                        </button>
                        <button id="navTrigger" class="flex items-center p-2 rounded-full xl:hidden bg-secondary-color">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2">
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
                    <a href="index.html" class="text-2xl">Home</a>
                    <a class="text-2xl opacity-80" href="menu.html"> Menu </a>
                    <a class="text-2xl opacity-80" href="custom-pizza.html">
                        Custom Pizza
                    </a>
                    <a class="text-2xl opacity-80" href="contact-us.html"> Contact </a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section id="custom-order"
            class="container flex flex-col-reverse grid-cols-12 mt-12 lg:grid font-aesthetnova md:mt-20 gap-x-12 lg:gap-y-0 gap-y-8">
            <div class="relative flex flex-col col-span-7 gap-4 wrap">
                <div class="space-y-2 detail-order">
                    <h5>Custom Pizza - (XL)</h5>
                    <p class="text-lg text-highlight-content">
                        Mozzarela Chees , Nuttela Chocolate , Peanut Butter , Bluberry Jam
                    </p>
                </div>
                <hr />
                <div class="flex flex-col overflow-hidden accordion-wrapper">
                    <div class="accordion-head">
                        <div
                            class="flex items-center justify-between pb-4 cursor-pointer lg:pb-6 head-wrapper-accordion">
                            <p class="text-xl lg:text-4xl">Size</p>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="p-2 transition-all duration-300 ease-in-out rounded-full bg-secondary-accent-color"
                                width="32" height="32" viewBox="0 0 42 25" fill="none">
                                <path
                                    d="M2.52604 -1.10417e-07L-9.74969e-07 2.69531L20.8333 25L41.6667 2.69531L39.1536 -1.71146e-06L20.8333 19.5964L2.52604 -1.10417e-07Z"
                                    fill="#E8E0CE" />
                            </svg>
                        </div>
                    </div>
                    <div
                        class="text-xl transition-all border-b-[1px] duration-300 ease-in-out accordion-content max-h-0">
                        <div class="flex flex-wrap items-center gap-3 pb-6 mt-3 lg:mt-6 wrap">
                            <button class="w-[22%] px-3 py-1.5 rounded-full bg-secondary-color">
                                XL
                            </button>
                            <button
                                class="w-[22%] px-3 py-1.5 rounded-full outline outline-2 outline-white hover:outline-none hover:bg-red-500 transition-all ease-in-out duration-500">
                                LG
                            </button>
                            <button
                                class="w-[22%] px-3 py-1.5 rounded-full outline outline-2 outline-white hover:outline-none hover:bg-red-500 transition-all ease-in-out duration-500">
                                MD
                            </button>
                            <button
                                class="w-[22%] px-3 py-1.5 rounded-full outline outline-2 outline-white hover:outline-none hover:bg-red-500 transition-all ease-in-out duration-500">
                                SM
                            </button>
                        </div>
                        <p class="text-highlight-content">Note :</p>
                        <ul class="pb-6 space-y-1 list-disc list-inside text-accent-color">
                            <li>Small Size ( 3 Flavor )</li>
                            <li>Medium Size ( 5 Flavor )</li>
                            <li>Large Size( 7 Flavor )</li>
                            <li>Small Size ( 9 Flavor )</li>
                        </ul>
                    </div>
                </div>
                <div class="flex flex-col overflow-hidden accordion-wrapper">
                    <div class="accordion-head">
                        <div
                            class="flex items-center justify-between pb-3 cursor-pointer lg:pb-6 head-wrapper-accordion">
                            <p class="text-xl lg:text-4xl">Chocolate</p>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="p-2 transition-all duration-300 ease-in-out rounded-full bg-secondary-accent-color"
                                width="32" height="32" viewBox="0 0 42 25" fill="none">
                                <path
                                    d="M2.52604 -1.10417e-07L-9.74969e-07 2.69531L20.8333 25L41.6667 2.69531L39.1536 -1.71146e-06L20.8333 19.5964L2.52604 -1.10417e-07Z"
                                    fill="#E8E0CE" />
                            </svg>
                        </div>
                    </div>
                    <div
                        class="text-xl transition-all border-b-[1px] duration-300 ease-in-out accordion-content max-h-0">
                        <div class="flex flex-wrap items-center lg:gap-3 gap-2 pb-6 pl-0.5 lg:mt-6 mt-3 wrap">
                            <button
                                class="px-8 py-3 text-sm rounded-full w-fit bg-secondary-color 3xl:text-xl lg:text-xl">
                                Nuttela
                            </button>
                            <button
                                class="px-8 py-3 text-sm transition-all duration-500 ease-in-out rounded-full w-fit outline outline-2 outline-white hover:outline-none hover:bg-red-500 3xl:text-xl lg:text-xl">
                                White Chocolate
                            </button>
                            <button
                                class="px-8 py-3 text-sm transition-all duration-500 ease-in-out rounded-full w-fit outline outline-2 outline-white hover:outline-none hover:bg-red-500 3xl:text-xl lg:text-xl">
                                Chocolate sprinkles
                            </button>
                            <button
                                class="px-8 py-3 text-sm transition-all duration-500 ease-in-out rounded-full w-fit outline outline-2 outline-white hover:outline-none hover:bg-red-500 3xl:text-xl lg:text-xl">
                                Chocolate
                            </button>
                            <button
                                class="px-8 py-3 text-sm transition-all duration-500 ease-in-out rounded-full w-fit outline outline-2 outline-white hover:outline-none hover:bg-red-500 3xl:text-xl lg:text-xl">
                                Dairy Milk
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col overflow-hidden accordion-wrapper">
                    <div class="accordion-head">
                        <div
                            class="flex items-center justify-between pb-3 cursor-pointer lg:pb-6 head-wrapper-accordion">
                            <p class="text-xl lg:text-4xl">Cheese</p>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="p-2 transition-all duration-300 ease-in-out rounded-full bg-secondary-accent-color"
                                width="32" height="32" viewBox="0 0 42 25" fill="none">
                                <path
                                    d="M2.52604 -1.10417e-07L-9.74969e-07 2.69531L20.8333 25L41.6667 2.69531L39.1536 -1.71146e-06L20.8333 19.5964L2.52604 -1.10417e-07Z"
                                    fill="#E8E0CE" />
                            </svg>
                        </div>
                    </div>
                    <div
                        class="text-xl transition-all border-b-[1px] duration-300 ease-in-out accordion-content max-h-0">
                        <div class="flex flex-wrap items-center lg:gap-3 gap-2 pb-6 pl-0.5 lg:mt-6 mt-3 wrap">
                            <button
                                class="px-8 py-3 text-sm rounded-full w-fit bg-secondary-color 3xl:text-xl lg:text-xl">
                                Cheddar Chees
                            </button>
                            <button
                                class="px-8 py-3 text-sm transition-all duration-500 ease-in-out rounded-full w-fit outline outline-2 outline-white hover:outline-none hover:bg-red-500 3xl:text-xl lg:text-xl">
                                Mozarela Chees
                            </button>
                            <button
                                class="px-8 py-3 text-sm transition-all duration-500 ease-in-out rounded-full w-fit outline outline-2 outline-white hover:outline-none hover:bg-red-500 3xl:text-xl lg:text-xl">
                                Provolone Chees
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col overflow-hidden accordion-wrapper">
                    <div class="accordion-head">
                        <div
                            class="flex items-center justify-between pb-3 cursor-pointer lg:pb-6 head-wrapper-accordion">
                            <p class="text-xl lg:text-4xl">Jam</p>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="p-2 transition-all duration-300 ease-in-out rounded-full bg-secondary-accent-color"
                                width="32" height="32" viewBox="0 0 42 25" fill="none">
                                <path
                                    d="M2.52604 -1.10417e-07L-9.74969e-07 2.69531L20.8333 25L41.6667 2.69531L39.1536 -1.71146e-06L20.8333 19.5964L2.52604 -1.10417e-07Z"
                                    fill="#E8E0CE" />
                            </svg>
                        </div>
                    </div>
                    <div
                        class="text-xl transition-all border-b-[1px] duration-300 ease-in-out accordion-content max-h-0">
                        <div class="flex flex-wrap items-center lg:gap-3 gap-2 pb-6 pl-0.5 lg:mt-6 mt-3 wrap">
                            <button
                                class="px-8 py-3 text-sm rounded-full w-fit bg-secondary-color 3xl:text-xl lg:text-xl">
                                Peanut butter
                            </button>
                            <button
                                class="px-8 py-3 text-sm transition-all duration-500 ease-in-out rounded-full w-fit outline outline-2 outline-white hover:outline-none hover:bg-red-500 3xl:text-xl lg:text-xl">
                                Blueberry jam
                            </button>
                            <button
                                class="px-8 py-3 text-sm transition-all duration-500 ease-in-out rounded-full w-fit outline outline-2 outline-white hover:outline-none hover:bg-red-500 3xl:text-xl lg:text-xl">
                                Strawberry jam
                            </button>
                            <button
                                class="px-8 py-3 text-sm transition-all duration-500 ease-in-out rounded-full w-fit outline outline-2 outline-white hover:outline-none hover:bg-red-500 3xl:text-xl lg:text-xl">
                                Chocolate spread
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <img src="../asset/CustomOrder.png"
                class="relative top-0 w-full col-span-5 row-span-5 wrap lg:sticky lg:top-36" alt="" />
            <div
                class="container fixed z-50 w-full text-white translate-x-1/2 right-1/2 bottom-4 add-to-cart-custom-order">
                <div
                    class="flex flex-col items-center justify-between w-full p-6 rounded-lg lg:gap-y-0 gap-y-4 lg:flex-row wrap outline outline-1 outline-highlight-content bg-secondary-accent-color">
                    <div class="lg:w-[80%] w-full space-y-1 wrap">
                        <p class="text-xl lg:text-2xl">Custom Pizza - (XL)</p>
                        <p class="text-sm lg:text-xl text-highlight-content">
                            Mozzarela Chees , Nuttela Chocolate , Peanut Butter , Bluberry
                            Jam
                        </p>
                        <p class="text-xl lg:text-2xl">Total : Rp.250.000</p>
                    </div>
                    <div
                        class="flex flex-col items-center justify-between lg:w-[20%] w-full gap-3 rounded-lg add-to-cart">
                        <div class="flex items-center justify-between w-full gap-3 wrap">
                            <button
                                class="gap-3 2xl:px-4 px-3 py-0.5 md:py-2.5 rounded-lg w-full outline outline-1 flex justify-center outline-accent-color">
                                <?xml version="1.0" ?>
                                <!DOCTYPE svg
                                    PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'>
                                <svg height="32px" id="Layer_1" fill="white"
                                    style="enable-background: new 0 0 512 512" version="1.1" viewBox="0 0 512 512"
                                    width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path
                                        d="M417.4,224H94.6C77.7,224,64,238.3,64,256c0,17.7,13.7,32,30.6,32h322.8c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                </svg>
                            </button>
                            <button
                                class="w-full gap-3 px-2 py-1 text-lg font-semibold rounded-lg md:py-3 2xl:text-lg 2xl:px-8 outline outline-1 outline-accent-color">
                                1
                            </button>
                            <button
                                class="gap-3 2xl:px-4 px-3 py-0.5 md:py-2.5 rounded-lg w-full flex justify-center outline outline-1 outline-accent-color">
                                <?xml version="1.0" ?>
                                <!DOCTYPE svg
                                    PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'>
                                <svg height="32px" id="Layer_1" fill="white"
                                    style="enable-background: new 0 0 512 512" version="1.1" viewBox="0 0 512 512"
                                    width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path
                                        d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                </svg>
                            </button>
                        </div>
                        <button
                            class="w-full gap-3 px-2 py-3 text-sm font-semibold rounded-lg 2xl:text-lg 2xl:px-5 bg-secondary-color">
                            ADD TO CART
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <!-- SideBar  -->
        <div id="sidebarCart"
            class="fixed inset-0 z-50 flex items-center justify-end transition-all duration-[400ms] ease-linear translate-x-full font-aesthetnova">
            <div class="flex w-full h-full max-w-3xl">
                <!-- Others Also Bought Section -->
                <div class="md:w-[38%] md:block hidden bg-[#090E1A] bg-opacity-85">
                    <h6 class="mt-8 mb-4 font-semibold text-center">
                        OTHERS ALSO BOUGHT
                    </h6>
                    <div class="swiper">
                        <div
                            class="px-4 pb-8 3xl:max-h-[52.5rem] 2xl:max-h-[39rem] xl:max-h-[43em] other-item-content">
                            <div class="swiper-wrapper">
                                <!-- Repeat this block for each item -->
                                <div class="swiper-slide">
                                    <div
                                        class="flex flex-col items-center w-full rounded-lg shadow-xl bg-secondary-accent-color max-h-fit outline outline-1 outline-highlight-content">
                                        <img src="../asset/Booba Menu/Choco bobba.jpg" alt="Sicilian Pizza"
                                            class="rounded-t-lg h-[180px] w-full object-cover" />
                                        <div class="flex items-center justify-between w-full p-4 wrap">
                                            <div class="flex flex-col">
                                                <p class="text-xl">Sicilian Pizza</p>
                                                <p class="text-lg text-gray-3 00">Rp 500.000</p>
                                            </div>
                                            <button class="w-10 h-10 text-red-500 bg-white rounded-full">
                                                <img src="../asset/SVG/Cart_Plus-Sidebar.svg" alt=""
                                                    class="w-5 mx-auto" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div
                                        class="flex flex-col items-center w-full rounded-lg shadow-xl bg-secondary-accent-color max-h-fit outline outline-1 outline-highlight-content">
                                        <img src="../asset/Booba Menu/Brown Sugar Syrup and Milk Tea bobba.jpg"
                                            alt="Sicilian Pizza" class="rounded-t-lg h-[180px] w-full object-cover" />
                                        <div class="flex items-center justify-between w-full p-4 wrap">
                                            <div class="flex flex-col">
                                                <p class="text-xl">Sicilian Pizza</p>
                                                <p class="text-xl">Rp 500.000</p>
                                            </div>
                                            <button class="w-10 h-10 text-red-500 bg-white rounded-full">
                                                <img src="../asset/SVG/Cart_Plus-Sidebar.svg" alt=""
                                                    class="w-5 mx-auto" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div
                                        class="flex flex-col items-center w-full rounded-lg shadow-xl bg-secondary-accent-color max-h-fit outline outline-1 outline-highlight-content">
                                        <img src="../asset/Booba Menu/Oreo Bobba.jpg" alt="Sicilian Pizza"
                                            class="rounded-t-lg h-[180px] w-full object-cover" />
                                        <div class="flex items-center justify-between w-full p-4 wrap">
                                            <div class="flex flex-col">
                                                <p class="text-xl">Sicilian Pizza</p>
                                                <p class="text-xl">Rp 500.000</p>
                                            </div>
                                            <button class="w-10 h-10 text-red-500 bg-white rounded-full">
                                                <img src="../asset/SVG/Cart_Plus-Sidebar.svg" alt=""
                                                    class="w-5 mx-auto" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div
                                        class="flex flex-col items-center w-full rounded-lg shadow-xl bg-secondary-accent-color max-h-fit outline outline-1 outline-highlight-content">
                                        <img src="../asset/Booba Menu/Milk bobba.jpg" alt="Sicilian Pizza"
                                            class="rounded-t-lg h-[180px] w-full object-cover" />
                                        <div class="flex items-center justify-between w-full p-4 wrap">
                                            <div class="flex flex-col">
                                                <p class="text-xl">Sicilian Pizza</p>
                                                <p class="text-xl">Rp 500.000</p>
                                            </div>
                                            <button class="w-10 h-10 text-red-500 bg-white rounded-full">
                                                <img src="../asset/SVG/Cart_Plus-Sidebar.svg" alt=""
                                                    class="w-5 mx-auto" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of item block -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- My Cart Section -->
                <div class="relative md:w-[62%] w-full flex flex-col gap-3 p-6 bg-secondary-accent-color shadow-lg">
                    <div class="flex items-center justify-between wrap">
                        <p class="text-2xl md:my-3">MY CART</p>
                        <button id="closeCart" class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <hr />
                    <div class="w-full swiper">
                        <div
                            class="my-2 3xl:max-h-[630px] 2xl:max-h-[410px] xl:max-h-[31em] max-h-[24em] sm:max-h-[38em] w-full cart-added-content overflow-hidden">
                            <!-- Repeat this block for each cart item -->
                            <div class="h-fit swiper-wrapper">
                                <div class="swiper-slide">
                                    <div
                                        class="flex flex-col items-center md:p-0 p-0.5 md:flex-row gap-x-6 md:gap-y-0 gap-y-3">
                                        <img src="../asset/Coffe menu/capuccino Coffe.jpg" alt="Sicilian Pizza"
                                            class="object-cover w-full rounded h-44 md:w-44 md:h-44" />
                                        <div class="flex flex-col w-full gap-2 md:gap-3 text-wrap">
                                            <p class="text-xl font-semibold md:text-lg line-clamp-1">
                                                Capuccino Coffee
                                            </p>
                                            <p class="text-xl md:text-lg text-highlight-content">
                                                Extra
                                            </p>
                                            <div class="items-center hidden gap-3 md:flex wrap">
                                                <div
                                                    class="flex items-center justify-center gap-8 px-4 py-1.5 rounded-full w-fit outline outline-1 outline-white">
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="16px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H94.6C77.7,224,64,238.3,64,256c0,17.7,13.7,32,30.6,32h322.8c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                    <span class="text-base md:text-lg text-accent-color">1</span>
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="16px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <button
                                                    class="flex items-center justify-center p-1.5 rounded-full bg-secondary-color">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                        fill="none" viewBox="0 0 26 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="flex items-center justify-between wrap">
                                                <p class="text-xl md:text-lg">Rp 1.500.000</p>
                                                <div
                                                    class="flex items-center justify-center gap-8 px-5 py-1.5 rounded-full md:hidden w-fit outline outline-1 outline-white">
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="24px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H94.6C77.7,224,64,238.3,64,256c0,17.7,13.7,32,30.6,32h322.8c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                    <span class="text-xl md:text-lg text-accent-color">2</span>
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="24px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <button
                                            class="absolute top-2 right-0 md:hidden flex items-center justify-center p-1.5 rounded-l-full bg-secondary-color">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 26 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div
                                        class="flex flex-col items-center md:p-0 p-0.5 md:flex-row gap-x-6 md:gap-y-0 gap-y-3">
                                        <img src="../asset/Coffe menu/capuccino Coffe.jpg" alt="Sicilian Pizza"
                                            class="object-cover w-full rounded h-44 md:w-44 md:h-44" />
                                        <div class="flex flex-col w-full gap-2 md:gap-3 text-wrap">
                                            <p class="text-xl font-semibold md:text-lg line-clamp-1">
                                                Capuccino Coffee
                                            </p>
                                            <p class="text-xl md:text-lg text-highlight-content">
                                                Extra
                                            </p>
                                            <div class="items-center hidden gap-3 md:flex wrap">
                                                <div
                                                    class="flex items-center justify-center gap-8 px-4 py-1.5 rounded-full w-fit outline outline-1 outline-white">
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="16px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H94.6C77.7,224,64,238.3,64,256c0,17.7,13.7,32,30.6,32h322.8c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                    <span class="text-base md:text-lg text-accent-color">1</span>
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="16px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <button
                                                    class="flex items-center justify-center p-1.5 rounded-full bg-secondary-color">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                        fill="none" viewBox="0 0 26 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="flex items-center justify-between wrap">
                                                <p class="text-xl md:text-lg">Rp 500.000</p>
                                                <div
                                                    class="flex items-center justify-center gap-8 px-5 py-1.5 rounded-full md:hidden w-fit outline outline-1 outline-white">
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="24px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H94.6C77.7,224,64,238.3,64,256c0,17.7,13.7,32,30.6,32h322.8c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                    <span class="text-xl md:text-lg text-accent-color">1</span>
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="24px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <button
                                            class="absolute top-2 right-0 md:hidden flex items-center justify-center p-1.5 rounded-l-full bg-secondary-color">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 26 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div
                                        class="flex flex-col items-center md:p-0 p-0.5 md:flex-row gap-x-6 md:gap-y-0 gap-y-3">
                                        <img src="../asset/Coffe menu/capuccino Coffe.jpg" alt="Sicilian Pizza"
                                            class="object-cover w-full rounded h-44 md:w-44 md:h-44" />
                                        <div class="flex flex-col w-full gap-2 md:gap-3 text-wrap">
                                            <p class="text-xl font-semibold md:text-lg line-clamp-1">
                                                Capuccino Coffee
                                            </p>
                                            <p class="text-xl md:text-lg text-highlight-content">
                                                Extra
                                            </p>
                                            <div class="items-center hidden gap-3 md:flex wrap">
                                                <div
                                                    class="flex items-center justify-center gap-8 px-4 py-1.5 rounded-full w-fit outline outline-1 outline-white">
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="16px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H94.6C77.7,224,64,238.3,64,256c0,17.7,13.7,32,30.6,32h322.8c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                    <span class="text-base md:text-lg text-accent-color">1</span>
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="16px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <button
                                                    class="flex items-center justify-center p-1.5 rounded-full bg-secondary-color">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                        fill="none" viewBox="0 0 26 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="flex items-center justify-between wrap">
                                                <p class="text-xl md:text-lg">Rp 1.500.000</p>
                                                <div
                                                    class="flex items-center justify-center gap-8 px-5 py-1.5 rounded-full md:hidden w-fit outline outline-1 outline-white">
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="24px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H94.6C77.7,224,64,238.3,64,256c0,17.7,13.7,32,30.6,32h322.8c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                    <span class="text-xl md:text-lg text-accent-color">2</span>
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="24px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <button
                                            class="absolute top-2 right-0 md:hidden flex items-center justify-center p-1.5 rounded-l-full bg-secondary-color">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 26 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div
                                        class="flex flex-col items-center md:p-0 p-0.5 md:flex-row gap-x-6 md:gap-y-0 gap-y-3">
                                        <img src="../asset/Coffe menu/capuccino Coffe.jpg" alt="Sicilian Pizza"
                                            class="object-cover w-full rounded h-44 md:w-44 md:h-44" />
                                        <div class="flex flex-col w-full gap-2 md:gap-3 text-wrap">
                                            <p class="text-xl font-semibold md:text-lg line-clamp-1">
                                                Capuccino Coffee
                                            </p>
                                            <p class="text-xl md:text-lg text-highlight-content">
                                                Extra
                                            </p>
                                            <div class="items-center hidden gap-3 md:flex wrap">
                                                <div
                                                    class="flex items-center justify-center gap-8 px-4 py-1.5 rounded-full w-fit outline outline-1 outline-white">
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="16px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H94.6C77.7,224,64,238.3,64,256c0,17.7,13.7,32,30.6,32h322.8c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                    <span class="text-base md:text-lg text-accent-color">1</span>
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="16px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <button
                                                    class="flex items-center justify-center p-1.5 rounded-full bg-secondary-color">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                        fill="none" viewBox="0 0 26 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="flex items-center justify-between wrap">
                                                <p class="text-xl md:text-lg">Rp 500.000</p>
                                                <div
                                                    class="flex items-center justify-center gap-8 px-5 py-1.5 rounded-full md:hidden w-fit outline outline-1 outline-white">
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="24px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H94.6C77.7,224,64,238.3,64,256c0,17.7,13.7,32,30.6,32h322.8c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                    <span class="text-xl md:text-lg text-accent-color">1</span>
                                                    <button class="">
                                                        <svg height="24px" id="Layer_1" fill="white"
                                                            style="enable-background: new 0 0 512 512" version="1.1"
                                                            viewBox="0 0 512 512" width="24px" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path
                                                                d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <button
                                            class="absolute top-2 right-0 md:hidden flex items-center justify-center p-1.5 rounded-l-full bg-secondary-color">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 26 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- End of cart item block -->
                        </div>
                    </div>
                    <hr class="" />
                    <div class="mt-auto">
                        <p class="text-sm">Shipping and taxes calculated at checkout.</p>
                        <a href="cart.html">
                            <button class="w-full py-3 mt-4 font-semibold bg-red-500 hover:bg-red-600">
                                VIEW CART
                            </button>
                        </a>
                        <a href="menu.html">
                            <button class="w-full mt-4 text-center">
                                Buy Other Product
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login & register Box -->
        <div id="LoginRegisterBox"
            class="fixed inset-0 z-50 flex items-center justify-center invisible bg-black opacity-0 bg-opacity-70 add-to-cart-quick-list font-aesthetnova">
            <div id="LoginBox"
                class="relative flex flex-col md:flex-row w-[90%] justify-center overflow-hidden md:w-[45%] h-[400px] md:h-[550px] p-4 md:p-8 gap-6 md:gap-9 rounded-lg bg-secondary-accent-color box-cart">
                <h5 class="absolute mt-3 text-gray-300 translate-x-1/2 lg:top-8 top-5 right-1/2">
                    Login
                </h5>
                <form action="" class="flex flex-col justify-center lg:w-[90%] w-full col-span-3 gap-4">
                    <div class="relative">
                        <input required type="text"
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
                        <input required type="text"
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
                        Login
                    </button>
                    <p class="text-center">
                        Don't Have Account ?
                        <span id="RegisterBoxOpen" class="text-red-500 cursor-pointer">Sign Up</span>
                    </p>
                </form>
                <img src="../asset/Bobba-login.png" class="absolute w-[10%] bottom-0 right-0" alt="" />
                <img src="../asset/Coffe-Login.png" class="absolute w-[8%] top-0 left-0" alt="" />
                <img src="../asset/Pizza-Hero.png"
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
                <form action="" class="flex flex-col justify-center lg:w-[90%] w-full col-span-3 gap-4">
                    <div class="relative">
                        <input required type="text"
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
                        <input required type="text"
                            class="w-full h-12 border-b-[1px] border-white bg-transparent outline-none"
                            placeholder="Phone Number" />
                        <svg class="absolute right-0 w-6 h-6 bottom-2" fill="white" stroke-width="1.5"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.1182 14.702L14 15.5C11.2183 14.1038 9.5 12.5 8.5 10L9.26995 5.8699L7.81452 2L4.0636 2C2.93605 2 2.04814 2.93178 2.21654 4.04668C2.63695 6.83 3.87653 11.8765 7.5 15.5C11.3052 19.3052 16.7857 20.9564 19.802 21.6127C20.9668 21.8662 22 20.9575 22 19.7655L22 16.1812L18.1182 14.702Z"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="relative">
                        <input required type="text"
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
                <img src="../asset/Bobba-login.png" class="absolute w-[10%] bottom-0 right-0" alt="" />
                <img src="../asset/Coffe-Login.png" class="absolute w-[8%] top-0 left-0" alt="" />
                <img src="../asset/Pizza-Hero.png"
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
    </main>
    <footer class="flex flex-col bg-secondary-accent-color font-aesthetnova">
        <div class="container flex flex-col gap-12 py-12 md:py-20">
            <div class="flex flex-wrap w-full grid-cols-3 gap-20 md:grid wrapper-address">
                <div class="flex flex-col items-center justify-center gap-4 mx-auto Wrap">
                    <h5>ADDRESS</h5>
                    <p class="3xl:w-1/2 w-[70%] md:text-xl text-lg text-center">
                        Cafe Travel Jalan Kakap Raya no 155 , Tanggerang , Karwaci
                    </p>
                </div>
                <div class="flex flex-col items-center justify-center gap-4 mx-auto Wrap">
                    <h5>RESERVATION</h5>
                    <p class="3xl:w-1/2 w-[70%] md:text-xl text-lg text-center">
                        0813 - 1480 - 1945 /CafeTravel@gmail.com
                    </p>
                </div>
                <div class="flex flex-col items-center justify-center gap-4 mx-auto Wrap">
                    <h5>OPEN HOURS</h5>
                    <p class="3xl:w-1/2 w-[70%] text-center md:text-xl text-lg">
                        Monday - Friday : 10 AM - 11 PM Saturday - Sunday : 9 AM - 1 PM
                    </p>
                </div>
            </div>
            <div class="flex flex-col items-center gap-6 sosial-media">
                <div class="flex items-center justify-center gap-6 box-sosial wrap">
                    <div class="flex items-center justify-center w-12 h-12 border-2 border-white rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M16.1801 1.90354C17.5685 1.90354 18.8999 2.45506 19.8816 3.43676C20.8633 4.41847 21.4149 5.74995 21.4149 7.13829V16.1801C21.4149 17.5685 20.8633 18.8999 19.8816 19.8816C18.8999 20.8633 17.5685 21.4149 16.1801 21.4149H7.13829C5.74995 21.4149 4.41847 20.8633 3.43676 19.8816C2.45506 18.8999 1.90354 17.5685 1.90354 16.1801V7.13829C1.90354 5.74995 2.45506 4.41847 3.43676 3.43676C4.41847 2.45506 5.74995 1.90354 7.13829 1.90354H16.1801ZM16.1801 0H7.13829C5.24683 0.00564898 3.43446 0.75953 2.097 2.097C0.75953 3.43446 0.00564898 5.24683 0 7.13829V16.1801C0.00564898 18.0716 0.75953 19.8839 2.097 21.2214C3.43446 22.5589 5.24683 23.3128 7.13829 23.3184H16.1801C18.0716 23.3128 19.8839 22.5589 21.2214 21.2214C22.5589 19.8839 23.3128 18.0716 23.3184 16.1801V7.13829C23.3128 5.24683 22.5589 3.43446 21.2214 2.097C19.8839 0.75953 18.0716 0.00564898 16.1801 0Z"
                                fill="white" />
                            <path
                                d="M17.8792 4.04492C17.6095 4.04492 17.3459 4.12488 17.1217 4.2747C16.8975 4.42451 16.7227 4.63745 16.6195 4.88658C16.5163 5.13571 16.4893 5.40985 16.5419 5.67432C16.5946 5.9388 16.7244 6.18174 16.9151 6.37241C17.1058 6.56309 17.3487 6.69294 17.6132 6.74555C17.8776 6.79816 18.1518 6.77116 18.4009 6.66796C18.65 6.56477 18.863 6.39002 19.0128 6.16581C19.1626 5.94159 19.2426 5.67799 19.2426 5.40833C19.2426 5.22929 19.2073 5.052 19.1388 4.88658C19.0703 4.72116 18.9698 4.57086 18.8432 4.44426C18.7166 4.31765 18.5663 4.21722 18.4009 4.14871C18.2355 4.08019 18.0582 4.04492 17.8792 4.04492Z"
                                fill="white" />
                            <path
                                d="M11.7235 7.48778C12.5557 7.48731 13.3694 7.7337 14.0616 8.19577C14.7537 8.65784 15.2933 9.31483 15.612 10.0836C15.9307 10.8524 16.0142 11.6985 15.852 12.5147C15.6897 13.331 15.289 14.0808 14.7005 14.6693C14.1121 15.2578 13.3623 15.6585 12.546 15.8207C11.7297 15.983 10.8837 15.8995 10.1149 15.5808C9.34608 15.2621 8.68909 14.7225 8.22701 14.0303C7.76494 13.3381 7.51856 12.5245 7.51903 11.6922C7.52091 10.5777 7.96449 9.5094 8.75257 8.72132C9.54065 7.93324 10.609 7.48967 11.7235 7.48778ZM11.7235 5.58424C10.5154 5.58659 9.33507 5.94702 8.33174 6.61997C7.32841 7.29292 6.54708 8.24819 6.08649 9.36506C5.62591 10.4819 5.50674 11.7103 5.74404 12.8948C5.98135 14.0794 6.56448 15.1671 7.41974 16.0203C8.275 16.8736 9.364 17.4542 10.5491 17.6887C11.7343 17.9233 12.9623 17.8012 14.0781 17.338C15.1939 16.8748 16.1473 16.0913 16.8179 15.0864C17.4885 14.0815 17.8462 12.9003 17.8457 11.6922C17.8454 10.889 17.6868 10.0937 17.3788 9.35187C17.0708 8.61003 16.6196 7.93618 16.051 7.36887C15.4824 6.80157 14.8075 6.35194 14.0649 6.04572C13.3224 5.73949 12.5267 5.58268 11.7235 5.58424Z"
                                fill="white" />
                        </svg>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 border-2 border-white rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 12 25"
                            fill="none">
                            <path
                                d="M11.278 7.85913H7.43711V5.34007C7.43711 4.39404 8.06411 4.17348 8.50572 4.17348C8.94633 4.17348 11.2162 4.17348 11.2162 4.17348V0.0145697L7.48333 0C3.33949 0 2.39647 3.10185 2.39647 5.08685V7.85913H0V12.1446H2.39647C2.39647 17.6445 2.39647 24.2712 2.39647 24.2712H7.43711C7.43711 24.2712 7.43711 17.5792 7.43711 12.1446H10.8384L11.278 7.85913Z"
                                fill="white" />
                        </svg>
                    </div>
                    <div class="flex items-center justify-center w-12 h-12 border-2 border-white rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 26 26"
                            fill="none">
                            <path
                                d="M12.5755 1.33989e-06C10.4088 -0.00100024 8.27878 0.559528 6.39321 1.62693C4.50765 2.69432 2.93088 4.23215 1.81668 6.09044C0.702485 7.94874 0.0888854 10.0641 0.0357223 12.2301C-0.0174408 14.3962 0.491648 16.5391 1.51334 18.4498L0.0377433 23.8603C-0.0110401 24.0295 -0.0125623 24.2089 0.0333417 24.3789C0.0792457 24.5489 0.170824 24.7031 0.298143 24.8248C0.39291 24.9113 0.503995 24.9781 0.624888 25.0211C0.745782 25.0642 0.874053 25.0827 1.00219 25.0755C1.08842 25.0896 1.17635 25.0896 1.26259 25.0755L6.96245 23.4842C7.20928 23.4164 7.41908 23.2534 7.54569 23.0309C7.67229 22.8084 7.70534 22.5448 7.63756 22.2979C7.56977 22.0511 7.40671 21.8413 7.18424 21.7147C6.96178 21.5881 6.69812 21.555 6.45129 21.6228L2.3717 22.7223L3.48081 18.5752C3.51373 18.4527 3.52215 18.3249 3.5056 18.1991C3.48906 18.0733 3.44785 17.952 3.38436 17.8422C2.21675 15.8198 1.74903 13.4687 2.05374 11.1535C2.35845 8.83821 3.41856 6.68818 5.06968 5.03679C6.72079 3.3854 8.87064 2.32493 11.1858 2.01982C13.5011 1.71472 15.8522 2.18204 17.8748 3.34931C19.8974 4.51658 21.4783 6.31858 22.3724 8.47585C23.2665 10.6331 23.4238 13.0251 22.82 15.2809C22.2162 17.5367 20.8849 19.5303 19.0327 20.9524C17.1804 22.3746 14.9107 23.1459 12.5755 23.1466C11.981 23.1472 11.3875 23.0988 10.8009 23.002C10.549 22.9601 10.2908 23.0199 10.0829 23.1681C9.87497 23.3164 9.73433 23.541 9.69182 23.7928C9.64995 24.0447 9.7097 24.303 9.85795 24.5109C10.0062 24.7188 10.2309 24.8594 10.4827 24.9019C12.1925 25.1894 13.9434 25.1192 15.6247 24.6957C17.306 24.2721 18.8811 23.5044 20.2506 22.4411C21.6202 21.3779 22.7543 20.0421 23.5813 18.5182C24.4083 16.9943 24.9103 15.3155 25.0555 13.5878C25.2007 11.86 24.986 10.121 24.4249 8.48043C23.8638 6.8399 22.9686 5.33357 21.7957 4.05662C20.6229 2.77967 19.198 1.75986 17.6109 1.06162C16.0239 0.363384 14.3093 0.00189747 12.5755 1.33989e-06Z"
                                fill="white" />
                            <path
                                d="M11.6111 7.91823L10.4923 6.37512C10.3237 6.14387 10.1072 5.95175 9.85752 5.81193C9.60784 5.67211 9.33089 5.58787 9.04564 5.56499C8.75896 5.54387 8.47109 5.58461 8.20152 5.68445C7.93196 5.78429 7.687 5.94089 7.48324 6.14366L6.32591 7.30099C6.0673 7.56508 5.86545 7.87927 5.73276 8.22425C5.60008 8.56924 5.53936 8.93772 5.55435 9.30703C5.55435 11.0141 6.866 13.1648 9.41213 15.6724C12.3923 18.5657 14.4562 19.5301 15.8643 19.5301C16.2222 19.5395 16.5782 19.475 16.9101 19.3406C17.242 19.2062 17.5426 19.0048 17.7931 18.7489L18.9505 17.5916C19.161 17.3941 19.3246 17.1518 19.429 16.8826C19.5335 16.6134 19.5762 16.3243 19.554 16.0364C19.5318 15.7485 19.4452 15.4693 19.3007 15.2193C19.1562 14.9694 18.9574 14.7551 18.719 14.5922L17.2048 13.5024C16.9527 13.3216 16.6623 13.2014 16.3562 13.1512C16.0501 13.101 15.7365 13.1222 15.4399 13.213L14.0029 13.6663C13.9131 13.66 13.8266 13.63 13.7521 13.5795C12.8963 12.9651 12.133 12.2311 11.4857 11.3999C11.4794 11.3648 11.4794 11.3289 11.4857 11.2938C11.6111 10.8694 11.8232 10.1847 11.9679 9.7121C12.0615 9.40691 12.0779 9.08327 12.0156 8.77018C11.9533 8.4571 11.8143 8.16437 11.6111 7.91823ZM12.8552 15.2769C13.3709 15.5596 13.9768 15.6288 14.543 15.4698L16.0282 15.0262L17.581 16.2317L16.4333 17.3601C15.9703 17.8134 14.2633 17.6784 10.7816 14.2643C7.88831 11.4577 7.49288 9.92428 7.49288 9.26845C7.50013 9.04601 7.59349 8.83507 7.75328 8.68014L8.98777 7.53246L10.1258 9.12379C9.9715 9.59637 9.74968 10.3004 9.63395 10.7151C9.49656 11.1577 9.51356 11.6337 9.68217 12.0653C10.5139 13.3506 11.6085 14.4452 12.8938 15.2769H12.8552Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
                <div class="copyright">
                    <p class="text-xl">@CafeTravelRight 2024</p>
                </div>
            </div>
        </div>
        <div class="w-full overflow-x-hidden">
            <div class="img-showcase-food">
                <div class="grid grid-cols-6 swiper-wrapper">
                    <div class="img-wrap swiper-slide">
                        <img src="../asset/Logo/Pizza Menu/Meat Lovers.jpg" class="w-full h-[243px] object-cover"
                            alt="" />
                    </div>
                    <div class="img-wrap swiper-slide">
                        <img src="../asset/Logo/Pizza Menu/Blackpaper.jpg" class="w-full h-[243px] object-cover"
                            alt="" />
                    </div>
                    <div class="img-wrap swiper-slide">
                        <img src="../asset/Coffe menu/Caramel Hazelnut Iced Coffee.jpg"
                            class="w-full h-[243px] object-cover" alt="" />
                    </div>
                    <div class="img-wrap swiper-slide">
                        <img src="../asset/Coffe menu/capuccino Coffe.jpg" class="w-full h-[243px] object-cover"
                            alt="" />
                    </div>
                    <div class="img-wrap swiper-slide">
                        <img src="../asset/Coffe menu/Dalgona Coffee.jpg" class="w-full h-[243px] object-cover"
                            alt="" />
                    </div>
                    <div class="img-wrap swiper-slide">
                        <img src="../asset/Booba Menu/Milk bobba.jpg" class="w-full h-[243px] object-cover"
                            alt="" />
                    </div>
                    <!-- Left -->
                    <div class="img-wrap swiper-slide">
                        <img src="../asset/Logo/Pizza Menu/Chicken.jpg" class="w-full h-[243px] object-cover"
                            alt="" />
                    </div>
                    <div class="img-wrap swiper-slide">
                        <img src="../asset/Coffe menu/Dalgona Coffee.jpg" class="w-full h-[243px] object-cover"
                            alt="" />
                    </div>
                    <div class="img-wrap swiper-slide">
                        <img src="../asset/Logo/Pizza Menu/Peperoni.jpg" class="w-full h-[243px] object-cover"
                            alt="" />
                    </div>
                    <div class="img-wrap swiper-slide">
                        <img src="../asset/Coffe menu/Caramel Machiato.jpg" class="w-full h-[243px] object-cover"
                            alt="" />
                    </div>
                    <div class="img-wrap swiper-slide">
                        <img src="../asset/Booba Menu/Matcha.jpg" class="w-full h-[243px] object-cover"
                            alt="" />
                    </div>
                    <div class="img-wrap swiper-slide">
                        <img src="../asset/Booba Menu/Oreo Bobba.jpg" class="w-full h-[243px] object-cover"
                            alt="" />
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
<!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
      AOS.init();
  </script> -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="../js/swiper.js"></script>
<script src="../js/GSAP.js"></script>
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<script src="../js/sidebar.js"></script>
<script src="../js/boxLogin.js"></script>
<script>
    const accordionHeads = document.querySelectorAll(".accordion-head");

    accordionHeads.forEach((accordionHead) => {
        const accordionBody = accordionHead.nextElementSibling;

        // Set semua item terbuka pada awalnya
        accordionHead.classList.add("accordion-active");
        accordionBody.style.maxHeight = accordionBody.scrollHeight + "px";

        accordionHead.addEventListener("click", () => {
            const isActive = accordionHead.classList.contains("accordion-active");

            // Jika item yang diklik sudah aktif, tutup item tersebut
            if (isActive) {
                accordionHead.classList.remove("accordion-active");
                accordionBody.style.maxHeight = 0;
            } else {
                // Buka item yang diklik
                accordionHead.classList.add("accordion-active");
                accordionBody.style.maxHeight = accordionBody.scrollHeight + "px";
            }
        });
    });
</script>

</html>
