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
    @vite('resources/css/app.css')
</head>

<body>
    @include('layout.Navbar')
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
        @include('layout.Sidebar')
        @include('layout.AuthCustomer')
    </main>
    @include('layout.Footer')
</body>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="{{ asset('/js/swiper.js') }}"></script>
<script src="{{ asset('/js/GSAP.js') }}"></script>
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<script src="{{ asset('/js/sidebar.js') }}"></script>
<script src="{{ asset('/js/boxLogin.js') }}"></script>
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
