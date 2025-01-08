<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
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
        <section class="mt-10 md:mt-20 cart font-aesthetnova">
            <div class="container">
                <div class="flex flex-col grid-cols-12 gap-4 md:grid">
                    <div
                        class="sticky top-[20px] flex flex-col col-span-6 row-auto gap-4 text-base transition-all duration-300 ease-in-out h-fit box-cart lg:text-xl">
                        <div
                            class="flex flex-col p-4 rounded-lg md:p-8 gap-y-6 content-body bg-secondary-accent-color outline outline-1 outline-highlight-content">
                            <div id="order_notice" class="flex flex-col gap-3">
                                <span class="flex items-center justify-between">
                                    <p>Order Detail</p>
                                    @php
                                        // Menentukan kelas warna berdasarkan status_order
                                        $statusClass = '';
                                        switch ($orderTransactions->first()->order->status_order) {
                                            case 'paid':
                                                $statusClass = 'bg-purple-500 text-white'; // Warna hijau untuk 'paid'
                                                break;
                                            case 'serve':
                                                $statusClass = 'bg-teal-500 text-white'; // Warna biru untuk 'serve'
                                                break;
                                            case 'shipped':
                                                $statusClass = 'bg-indigo-500 text-white'; // Warna kuning untuk 'shipped'
                                                break;
                                            case 'completed':
                                                $statusClass = 'bg-green-500 text-white'; // Warna ungu untuk 'completed'
                                                break;
                                            case 'canceled':
                                                $statusClass = 'bg-secondary-color text-white'; // Warna ungu untuk 'completed'
                                                break;
                                            default:
                                                $statusClass = 'bg-gray-500 text-white'; // Warna abu-abu untuk status lainnya
                                                break;
                                        }
                                    @endphp
                                    <p
                                        class="py-1.5 w-[8rem] text-center font-medium rounded-full lg:text-lg text-sm {{ $statusClass }}">
                                        {{ $orderTransactions->first()->order->status_order }}
                                    </p>
                                </span>
                                <span class="flex items-center justify-between">
                                    <p>Invoice No.</p>
                                    <p>INVCT/{{ $orderTransactions->first()->order->created_at->format('Y/m/d') }}/{{ $orderTransactions->first()->order->transaction_ID }}
                                    </p>
                                </span>
                                <span class="flex items-center justify-between">
                                    <p>Order Date</p>
                                    <p>{{ $orderTransactions->first()->order->created_at->format('d M Y, H:i') }}</p>
                                </span>
                            </div>
                            <hr />
                            <div id="location" class="flex flex-col">
                                <p class="text-highlight-content">Delivery Information</p>
                                <p>
                                    {{ $orderTransactions->first()->order->location->first()->reciver_name ?? 'None' }}
                                    | (
                                    {{ $orderTransactions->first()->order->location->first()->reciver_number ?? 'None' }})
                                </p>
                                <p class="text-highlight-content">
                                    ({{ $orderTransactions->first()->order->location->first()->location_labe ?? 'None' }})
                                </p>
                                <p> {{ $orderTransactions->first()->order->location->first()->reciver_address ?? 'None' }}
                                </p>
                            </div>
                            <hr />
                            <div class="space-y-4 Payment_informations">
                                <p class="text-highlight-content">Payment Information</p>
                                <span class="flex items-center justify-between">
                                    <p>Payment Method</p>
                                    <p>Mid Trans</p>
                                </span>
                                <span class="flex items-center justify-between">
                                    <p>Total ({{ $orderTransactions->count() }} Items)</p>
                                    <p>Rp{{ number_format($orderTransactions->first()->order->total_amounts, 0, ',', '.') }}
                                    </p>
                                </span>
                                {{-- <span class="flex items-center justify-between">
                                    <p>Delivery Fee</p>
                                    <p>Rp20.000</p>
                                </span> --}}
                            </div>
                            <hr class="border-[1px] border-gray-500" />
                            <div class="flex justify-between gap-3 wrap">
                                <p class="text-highlight-content">Total</p>
                                <p>Rp{{ number_format($orderTransactions->first()->order->total_amounts, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col w-full col-span-6 row-auto gap-4 p-4 rounded-lg h-fit md:p-8 lg:gap-y-6 gap-y-5 content-body bg-secondary-accent-color outline outline-1 outline-highlight-content">
                        <p class="text-2xl text-highlight-content lg:text-3xl">
                            Order Summary
                        </p>
                        <div class="flex flex-col gap-6 wrap">
                            <!-- Repeated Content -->
                            @foreach ($orderTransactions as $transaction)
                                <div
                                    class="flex flex-col items-center w-full p-0 gap-x-8 gap-y-3 md:flex-row md:gap-y-0">
                                    <!-- Normal Menu Image -->
                                    <div class="img-wrap h-52 3xl:w-80 3xl:h-60 w-full md:w-[45%] md:h-44">
                                        @if ($transaction->order_type === 'normal_menu')
                                            <img src="{{ isset($transaction->menu) && $transaction->menu->image ? asset('storage/' . $transaction->menu->image) : 'https://salonlfc.com/wp-content/uploads/2018/01/image-not-found-scaled.png' }}"
                                                alt="{{ $transaction->menu_name ?? 'Unknown Menu' }}"
                                                class="object-cover w-full h-full rounded-lg" />
                                        @else
                                            <img src="{{ asset('/asset/CustomOrder.png') }}"
                                                class="object-cover w-full h-full rounded-lg" alt="Custom Order" />
                                        @endif
                                    </div>
                                    <div class="flex flex-col w-full gap-1.5 text-wrap md:w-[35%]">
                                        <p class="text-2xl font-medium line-clamp-1">
                                            {{ $transaction->order_type === 'normal_menu' ? $transaction->menu_name : 'Custom menu' }}
                                        </p>
                                        <div class="flex items-center gap-3 wrap">
                                            <p class="text-lg uppercase text-highlight-content">Size
                                                ({{ $transaction->size }})
                                            </p>
                                            @if ($transaction->order_type === 'custom_menu')
                                                <button data-custom-pizza="{{ $transaction->transaction_detail_ID }}"
                                                    id="btn-see-detail-custom"
                                                    class="px-2 py-1 rounded-lg w-fit bg-primary-color text-highlight-content"><i
                                                        class="ti ti-clipboard-text"></i></button>
                                            @endif
                                        </div>
                                        <div class="flex">
                                            <p class="text-xl">Rp
                                                {{ number_format($transaction->subtotal, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div
                                        class="w-full px-4 py-2 rounded-full md:w-[15%] quantity-area bg-secondary-color">
                                        <p class="text-center md:text-base ms-auto">
                                            Qty : {{ $transaction->quantity }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Repeated Content End -->
                        </div>
                    </div>
                    {{-- <div class="col-span-6 row-auto gap-4 text-base md:text-lg">
                        <div
                            class="sticky flex flex-col w-full gap-4 rounded-lg h-fit top-36 box-Location font-aesthetnova bg-secondary-accent-color outline outline-1 outline-highlight-content">
                            <div class="px-4 py-4 md:py-8 body md:px-8">
                                <div class="space-y-2 wrap">
                                    <p class="text-2xl text-highlight-content">
                                        Processing Order
                                    </p>
                                    <p class="text-lg">Estimated in the kitchen 14.10</p>
                                </div>
                                <div class="flex items-center justify-between gap-2.5 mt-6 lg:gap-4 progress-bar">
                                    <img src="{{ asset('/asset/CafeTravel.png') }}" class="rounded-full w-7 lg:w-9"
                                        alt="" />
                                    <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                                        <div class="bg-highlight-content h-1.5 rounded-full"></div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-32" viewBox="0 0 23 21"
                                        fill="none">
                                        <path
                                            d="M22.1196 6.65569L20.8672 1.63991C20.7136 1.02367 20.1601 0.591614 19.525 0.591614H2.61671C1.98156 0.591614 1.42805 1.02367 1.27307 1.63991L0.0207565 6.65569C0.00691885 6.7097 0 6.76647 0 6.82325C0 8.73152 1.47371 10.2853 3.28645 10.2853C4.3395 10.2853 5.27908 9.76043 5.88102 8.94616C6.48296 9.76043 7.42254 10.2853 8.47559 10.2853C9.52864 10.2853 10.4682 9.76043 11.0702 8.94616C11.6721 9.76043 12.6103 10.2853 13.6647 10.2853C14.7192 10.2853 15.6574 9.76043 16.2593 8.94616C16.8612 9.76043 17.7994 10.2853 18.8539 10.2853C20.6666 10.2853 22.1403 8.73152 22.1403 6.82325C22.1403 6.76647 22.1334 6.7097 22.1196 6.65569Z"
                                            fill="#F8C055" />
                                        <path
                                            d="M18.8539 12.0995C17.9115 12.0995 17.0162 11.8115 16.2593 11.2853C14.7455 12.3391 12.584 12.3391 11.0702 11.2853C9.55633 12.3391 7.39489 12.3391 5.88104 11.2853C5.12412 11.8115 4.22882 12.0995 3.28647 12.0995C2.60704 12.0995 1.96636 11.9403 1.38379 11.6689V19.0236C1.38379 19.788 2.00372 20.4084 2.76756 20.4084H8.30264V14.8692H13.8377V20.4084H19.3728C20.1366 20.4084 20.7566 19.788 20.7566 19.0236V11.6689C20.174 11.9403 19.5333 12.0995 18.8539 12.0995Z"
                                            fill="#F8C055" />
                                    </svg>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                                        <div class="bg-highlight-content h-1.5 rounded-full"></div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-32" viewBox="0 0 23 23"
                                        fill="none">
                                        <g clip-path="url(#clip0_1562_735)">
                                            <path
                                                d="M4.42661 20.9249C6.18234 20.9024 7.58825 19.3965 7.5668 17.5612C7.54535 15.7259 6.10467 14.2563 4.34894 14.2787C2.59322 14.3012 1.18731 15.8071 1.20876 17.6424C1.23021 19.4777 2.67089 20.9473 4.42661 20.9249Z"
                                                fill="#F8C055" />
                                            <path
                                                d="M18.9344 20.9256C20.6902 20.9032 22.0961 19.3972 22.0746 17.5619C22.0532 15.7266 20.6125 14.257 18.8568 14.2795C17.101 14.3019 15.6951 15.8079 15.7166 17.6431C15.738 19.4784 17.1787 20.948 18.9344 20.9256Z"
                                                fill="#F8C055" />
                                            <path
                                                d="M12.4849 4.74601C12.6732 4.94142 12.9272 5.05203 13.1926 5.05417L14.9169 11.5449C15.228 12.7151 14.9496 13.9815 14.1508 14.8638C14.1508 14.8638 13.1247 16.0196 11.5886 16.0214C11.1039 16.0178 10.6403 15.814 10.2989 15.4544C9.9575 15.0948 9.76602 14.6086 9.76626 14.1019C9.76616 13.4006 9.84111 12.7014 9.9897 12.0175C10.1813 11.2327 10.3064 10.9767 10.5363 10.4843C11.2865 10.377 11.5761 9.22292 11.0214 8.28316C10.4396 7.29488 9.16427 7.18167 7.62685 7.74409C6.08942 8.30652 4.65298 8.00329 2.66782 7.64841C0.671924 7.29173 0.359541 10.4933 1.80114 10.4933H2.67255C1.64228 11.1347 0.805319 12.066 0.257275 13.181C0.194521 13.3073 0.15619 13.4453 0.144471 13.587C0.132752 13.7288 0.147876 13.8716 0.188979 14.0073C0.230081 14.143 0.296356 14.2688 0.384015 14.3777C0.471674 14.4866 0.578998 14.5764 0.699853 14.6418C0.815206 14.7025 0.945752 14.724 1.07335 14.7035C1.20095 14.6829 1.31926 14.6214 1.41185 14.5273C1.89131 14.0177 2.48378 13.6397 3.13661 13.4272C3.54349 13.2999 3.96534 13.2325 4.39001 13.2268C5.49944 13.2281 6.56308 13.6895 7.34752 14.5097C8.13197 15.3299 8.57317 16.4419 8.57431 17.6017C8.57431 17.6916 8.57173 17.7822 8.56657 17.8735C8.56469 17.9042 8.56885 17.935 8.5788 17.9639C8.58875 17.9928 8.60428 18.0193 8.62442 18.0417C8.64456 18.0641 8.66889 18.082 8.69589 18.0941C8.7229 18.1063 8.75201 18.1126 8.78142 18.1125H13.6369C13.9127 18.1044 14.1766 17.9927 14.3802 17.798C14.5838 17.6033 14.7136 17.3384 14.7459 17.0519C14.8468 16.2212 15.1735 15.4381 15.6873 14.7957C16.2011 14.1533 16.8804 13.6785 17.6446 13.4276C18.0515 13.3003 18.4733 13.2329 18.898 13.2273C19.8644 13.2264 20.8011 13.5769 21.5474 14.2187C21.8517 14.4797 22.2835 14.1127 22.0966 13.7506L22.0914 13.7412C21.4706 12.5901 20.5278 11.6652 19.3895 11.0908C19.2267 11.0081 19.0617 10.934 18.8958 10.8662C18.84 7.86179 15.5043 5.05552 15.5043 5.05552C16.4002 5.11032 16.4316 4.17775 16.4316 4.17775C16.4866 3.04706 15.7544 2.14099 14.7442 2.079C14.4897 2.0652 14.2375 2.13443 14.0223 2.2771L13.4379 2.66073C13.2423 2.79248 13.0358 2.90568 12.8209 2.999C12.673 3.06154 12.5412 3.15947 12.4361 3.28492C12.3309 3.41037 12.2554 3.55984 12.2155 3.72134C12.2155 3.72134 11.9461 3.80489 11.8472 3.90103C11.7773 3.96347 11.7262 4.04572 11.7 4.13786C11.6738 4.22999 11.6737 4.32808 11.6996 4.4203C11.7256 4.51252 11.7765 4.59492 11.8462 4.65757C11.9159 4.72023 12.0015 4.76046 12.0926 4.77341C12.0926 4.77341 12.2301 4.79767 12.4849 4.74601Z"
                                                fill="#F8C055" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1562_735">
                                                <rect width="22" height="23" fill="white"
                                                    transform="translate(0.140625)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                                        <div class="bg-highlight-content h-1.5 rounded-full w-0"></div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-32" viewBox="0 0 23 23"
                                        fill="none">
                                        <g clip-path="url(#clip0_1562_742)">
                                            <path
                                                d="M21.5475 10.0039C21.547 10.0034 21.5465 10.0028 21.546 10.0023L12.5717 0.620483C12.1892 0.220398 11.6806 0 11.1396 0C10.5987 0 10.0901 0.220222 9.7074 0.620308L0.737846 9.9974C0.734825 10.0006 0.731804 10.0039 0.728782 10.007C-0.0567401 10.833 -0.0553973 12.1731 0.732643 12.997C1.09267 13.3736 1.56818 13.5917 2.07659 13.6145C2.09724 13.6166 2.11805 13.6176 2.13903 13.6176H2.49671V20.5221C2.49671 21.8884 3.56002 23 4.86721 23H8.37823C8.73406 23 9.02276 22.6984 9.02276 22.3262V16.9131C9.02276 16.2896 9.50783 15.7825 10.1042 15.7825H12.1751C12.7714 15.7825 13.2565 16.2896 13.2565 16.9131V22.3262C13.2565 22.6984 13.545 23 13.9011 23H17.4121C18.7193 23 19.7826 21.8884 19.7826 20.5221V13.6176H20.1142C20.655 13.6176 21.1636 13.3974 21.5465 12.9973C22.3353 12.1721 22.3357 10.8297 21.5475 10.0039Z"
                                                fill="#D0D0D0" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1562_742">
                                                <rect width="22" height="23" fill="white"
                                                    transform="translate(0.140625)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <!-- Clean Code -->
                                <div class="relative flex flex-col justify-center gap-6 mt-12 wrap-location-order">
                                    <div class="space-y-1.5 wrap">
                                        <!-- Cafe Travel Location -->
                                        <div class="flex items-center gap-6 cafe">
                                            <img src="{{ asset('/asset/CafeTravel.png') }}" class="w-12 rounded-full"
                                                alt="Cafe Travel" />
                                            <div class="desc">
                                                <p class="text-base lg:text-lg">
                                                    Cafe Travel - Perumnas 1
                                                </p>
                                                <p class="text-sm text-gray-400 lg:text-base">
                                                    Jl. Kakap Raya no 155, Karawaci, Karawaci Baru
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Divider Line -->
                                        <img src="{{ asset('/asset/line-location-order.png') }}" class="w-0.5 ml-6"
                                            alt="Divider Line" />
                                        <!-- University Location -->
                                        <div class="flex items-center gap-6 cafe">
                                            <img src="{{ asset('/asset/Pin-Location.png') }}"
                                                class="w-12 rounded-full" alt="Location Pin" />
                                            <div class="desc">
                                                <p class="text-base lg:text-lg">
                                                    Universitas Pelita Harapan
                                                </p>
                                                <p class="text-sm text-gray-400 lg:text-base">
                                                    Jalan Benton Junction Deket Lippo
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Distance Indicator -->
                                    <p class="top-0 right-0 text-base lg:absolute lg:text-sm text-highlight-content">
                                        0.16km
                                    </p>
                                    <!-- Input Field -->
                                    <div class="w-full wrap">
                                        <input type="text"
                                            class="w-full px-4 py-3 text-base rounded-lg outline-none"
                                            placeholder="Titip Di lobby" />
                                    </div>
                                </div>
                                <div class="mt-8 driver-location">
                                    <div class="flex items-center gap-6 cafe">
                                        <!-- Driver Info -->
                                        <img src="{{ asset('/asset/driver.png') }}" class="w-12 rounded-full"
                                            alt="Driver" />
                                        <div class="desc">
                                            <p class="text-lg">Irfan Dwi Yulianto</p>
                                            <span class="flex items-center gap-3">
                                                <p class="text-highlight-content">B 5671 TOH</p>
                                                <p class="text-base text-highlight-content">5.0</p>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Location Image -->
                                    <img src="{{ asset('/asset/Location.png') }}" class="w-full mt-8"
                                        alt="Location" />
                                </div>
                                <!-- Clean Code End -->
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
        <!-- SideBar  -->
        @include('layout.popovers.aside.sidebar-frontend')
        @include('layout.modal.custom-menu.custom-details')
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
<script src="{{ asset('/js/sidebar.js') }}"></script>
<script src="{{ asset('/js/boxLogin.js') }}"></script>

</html>
