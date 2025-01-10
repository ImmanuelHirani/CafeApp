<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" /> -->
    @vite('resources/css/app.css')
</head>

<body>
    @include('layout.Navbar')
    <main>
        <section class="mt-10 md:mt-20 contact-us">
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
                            @for ($i = 1; $i <= 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                    fill="none">
                                    <path
                                        d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                        class="{{ $i <= $averageRating ? 'fill-highlight-content' : 'fill-white' }}" />
                                </svg>
                            @endfor
                            <p class="text-xs">({{ $menuReviews->count() }})</p>
                        </div>
                        <p class="text-2xl md:text-4xl 3xl:text-5xl" class="py-1 line-clamp-1">
                            {{ $menuDetails->name ?? '' }}</p>
                    </span>
                    <span class="flex flex-row-reverse justify-between w-full md:gap-4 md:flex-col">
                        <p class="text-xl w-fit md:text-3xl">
                            Rp {{ number_format($selectedPrice, 0, ',', '.') }}
                        </p>
                        <div class="flex items-center gap-3 w-fit md:justify-normal">
                            @if ($menuDetails->stock == 0)
                                <p class="text-base text-white w-fit md:text-start text-end">
                                    <span class="text-highlight-content">This variant is out of stock</span>. Save it to
                                    your Wishlist to remember the menu you want to order.
                                </p>
                            @else
                                <i class="text-2xl w-fit ti ti-package text-highlight-content"></i>
                                <p class="text-lg w-fit md:text-start text-end text-highlight-content">
                                    Stock : ({{ $menuDetails->stock }})
                                </p>
                            @endif
                        </div>
                    </span>
                    <span class="flex-col hidden gap-3 md:flex">
                        <p class="text-xl md:text-2xl">Choose Size :</p>
                        <div class="flex items-center gap-3 flex-nowrap menu-selection-wrapper">
                            @isset($menuDetails)
                                @foreach ($menuDetails->properties as $property)
                                    @if ($property->is_active_properties != 0)
                                        <a href="{{ route('frontend.menu.details', ['id' => $menuDetails->menu_ID, 'size' => $property->size]) }}"
                                            class="w-full  py-3 uppercase rounded-full outline text-center outline-2 {{ $selectedProperty && $selectedProperty->size == $property->size ? 'bg-secondary-color outline-secondary-color' : 'outline-white hover:bg-secondary-color transition-all ease-in-out duration-300 hover:outline-none' }}">
                                            {{ $property->size }}
                                        </a>
                                    @endif
                                @endforeach
                            @else
                                <p>No sizes available for this menu.</p>
                            @endisset
                        </div>
                    </span>
                    <p class="text-base text-justify md:text-lg line-clamp-3">
                        {{ $menuDetails->menu_description ?? '' }}
                    </p>

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
                                <h3>{{ number_format($averageRating, 1) }}</h3>
                                <div class="flex items-center gap-1.5 star">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7" viewBox="0 0 21 20"
                                            fill="none">
                                            <path
                                                d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                                class="{{ $i <= $averageRating ? 'fill-highlight-content' : 'fill-white' }}" />
                                        </svg>
                                    @endfor
                                </div>
                            </span>
                            <p class="text-base md:text-xl">Based on {{ $menuReviews->count() }} reviews</p>
                        </div>
                        <div class="right-content">
                            <button id="reviewTrigger"
                                class="md:px-8 px-6 py-1.5 md:text-lg rounded-lg md:py-2 !text-base bg-secondary-color">
                                Write Review
                            </button>
                        </div>
                    </div>
                    <hr />
                    @if ($menuReviews->isEmpty())
                        <p class="text-base text-center text-gray-500 md:text-lg">No reviews available for this menu at
                            the moment.
                        </p>
                    @else
                        @foreach ($menuReviews as $index => $menuReview)
                            <div class="flex flex-col gap-6 h-fit review-item page-{{ ceil(($index + 1) / 5) }}">
                                <div id="customersReview" class="flex flex-col grid-cols-12 gap-4 md:grid">
                                    <p class="col-span-2 text-lg">{{ $menuReview->user->username }}</p>
                                    <!-- Nama Customer -->
                                    <div class="flex flex-col col-span-8 gap-3 review-comment">
                                        <div class="flex items-center gap-1.5 star">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $menuReview->rating)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7"
                                                        viewBox="0 0 21 20" fill="none">
                                                        <path
                                                            d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                                            class="fill-highlight-content" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7"
                                                        viewBox="0 0 21 20" fill="none">
                                                        <path
                                                            d="M8.8229 0.993308C9.63036 -0.0251352 11.1762 -0.0251331 11.9836 0.99331L14.4502 4.10433C14.6789 4.39282 14.9822 4.61319 15.3272 4.74157L19.0482 6.12602C20.2663 6.57924 20.744 8.04941 20.0249 9.13206L17.8284 12.4392C17.6247 12.7459 17.5088 13.1025 17.4934 13.4703L17.3265 17.437C17.2719 18.7355 16.0213 19.6441 14.7694 19.2948L10.9453 18.2277C10.5907 18.1288 10.2158 18.1288 9.8612 18.2277L6.03712 19.2948C4.78525 19.6441 3.53466 18.7355 3.48004 17.437L3.31318 13.4703C3.29771 13.1025 3.18185 12.7459 2.97817 12.4392L0.781612 9.13206C0.0625328 8.04941 0.540215 6.57924 1.75833 6.12602L5.47929 4.74157C5.82433 4.61319 6.12765 4.39282 6.35637 4.10433L8.8229 0.993308Z"
                                                            fill="white" />
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <p class="text-justify line-clamp-4 text-[17px]">
                                            {{ $menuReview->review_desc }}
                                        </p>
                                    </div>
                                    @auth
                                        <div class="flex items-center justify-end w-full col-span-2 gap-4 wrap">
                                            <p class="text-sm text-end text-highlight-content">
                                                {{ $menuReview->created_at->diffForHumans() }}
                                            </p>
                                            @if ($menuReview->user_ID === Auth::id())
                                                <form action="{{ route('menu.reviews.delete', $menuReview->review_ID) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-2 py-1 rounded-full bg-secondary-color">
                                                        <i class="text-2xl text-white ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endauth
                                    @guest
                                        <p
                                            class="self-start col-span-2 text-sm md:self-center text-end text-highlight-content">
                                            {{ $menuReview->created_at->diffForHumans() }}
                                        </p>
                                    @endguest
                                </div>
                                <hr />
                            </div>
                        @endforeach
                    @endif
                    <div class="flex items-center self-end md:gap-3 gap-1.5 wrap-button-next-prev"></div>
                </div>
                {{-- Review End --}}
            </div>
        </section>
        @include('layout.popovers.menu-details.cart-menu-mobile-insert')
        <!-- Review Box Wrapper -->
        @include('layout.modal.menu.review-menu')
        <!-- SideBar  -->
        @include('layout.popovers.aside.sidebar-frontend')
        <!-- Login & register Box -->
        @include('layout.modal.login-registerBox.Auth-Customer')
    </main>
    @include('layout.Footer')
</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="{{ asset('/js/swiper.js') }}"></script>
<script src="{{ asset('/js/GSAP.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const reviewsContainer = document.querySelector('.reviews-container');
        const reviewItems = document.querySelectorAll('.review-item');
        const paginationWrapper = document.querySelector('.wrap-button-next-prev');
        const itemsPerPage = 5; // Jumlah maksimal konten per halaman

        // Hitung jumlah halaman yang diperlukan
        const totalPages = Math.ceil(reviewItems.length / itemsPerPage);

        // Buat tombol paginasi secara dinamis
        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement('button');
            button.classList.add('md:w-[52px]', 'toggle-pagination', 'w-12', 'md:py-2.5', 'py-3',
                'hover:bg-red-500', 'transition-all', 'ease-in-out', 'duration-500', 'rounded-xl',
                'md:text-lg', 'text-base', 'text-balance');
            button.textContent = i;
            button.setAttribute('data-page', i);
            if (i === 1) button.classList.add('bg-red-500'); // Highlight halaman pertama secara default
            paginationWrapper.appendChild(button);
        }

        // Fungsi untuk menampilkan halaman tertentu
        function showPage(pageNumber) {
            // Hitung indeks awal dan akhir untuk halaman yang dipilih
            const startIndex = (pageNumber - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;

            // Sembunyikan semua item
            reviewItems.forEach((item, index) => {
                item.style.display = (index >= startIndex && index < endIndex) ? 'flex' : 'none';
            });

            // Perbarui status tombol paginasi
            const paginationButtons = document.querySelectorAll('.toggle-pagination');
            paginationButtons.forEach(button => {
                button.classList.remove('bg-red-500');
                if (parseInt(button.getAttribute('data-page')) === pageNumber) {
                    button.classList.add('bg-red-500');
                }
            });
        }

        // Tambahkan event listener ke tombol paginasi
        paginationWrapper.addEventListener('click', (event) => {
            if (event.target.classList.contains('toggle-pagination')) {
                const pageNumber = parseInt(event.target.getAttribute('data-page'));
                showPage(pageNumber);
            }
        });

        // Tampilkan halaman pertama secara default
        showPage(1);
    });
</script>

</html>
