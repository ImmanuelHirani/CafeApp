<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Draggable.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" /> -->
    @vite('resources/css/app.css')
</head>

<body>
    @include('layout.Navbar')
    <main>
        <section
            class="container md:grid flex flex-col grid-cols-12 gap-6 md:mt-20 mt-10 auto-rows-[100%] profile font-aesthetnova">
            <div class="col-span-4 overflow-hidden md:sticky top-36 h-fit rounded-2xl bg-secondary-accent-color">
                <div class="flex flex-col profile">
                    <div class="flex items-center pt-4 header">
                        <div class="flex items-center gap-12 px-8 rounded-lg wrap">
                            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://salonlfc.com/wp-content/uploads/2018/01/image-not-found-1-scaled.png' }}"
                                class="object-cover rounded-full w-[3.5rem] h-[3.5rem]" alt="">
                            <p class="text-xl 3xl:text-2xl line-clamp-1">
                                {{ Auth::user()->username ?? 'Not Set Username Yet' }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 py-6 body">
                        <hr class="border-4 border-primary-color">
                        <div
                            class="relative flex items-center gap-12 px-12 cursor-pointer sideMenu-tabs-toggle wrap group ">
                            <div
                                class="absolute left-0 h-[4.4rem] w-[0.8rem] line transition-all ease-in-out duration-300 group-hover:bg-secondary-color">
                            </div>
                            <i class="text-4xl w-[13%] text-white ti ti-user-circle"></i>
                            <p class="text-xl 3xl:text-2xl w-[77%]">Account Overview</p>
                        </div>
                        <hr class="border-4 border-primary-color">
                        <div
                            class="relative flex items-center gap-12 px-12 cursor-pointer sideMenu-tabs-toggle wrap group ">
                            <div
                                class="absolute left-0 h-[4.4rem] w-[0.8rem] line transition-all ease-in-out duration-300 group-hover:bg-secondary-color">
                            </div>
                            <i class="text-4xl w-[13%] text-white ti ti-clipboard-list"></i>
                            <p class="text-xl 3xl:text-2xl w-[77%]">My Order</p>
                        </div>
                        <hr class="border-4 border-primary-color">
                        <div
                            class="relative flex items-center gap-12 px-12 cursor-pointer sideMenu-tabs-toggle wrap group ">
                            <div
                                class="absolute left-0 h-[4.4rem] w-[0.8rem] line transition-all ease-in-out duration-300 group-hover:bg-secondary-color">
                            </div>
                            <i class="text-4xl w-[13%] text-white ti ti-shopping-bag-heart"></i>
                            <p class="text-xl 3xl:text-2xl w-[77%]">Wishlist</p>
                        </div>
                        <hr class="border-4 border-primary-color">
                        <label for="logout" type="submit"
                            class="relative flex items-center gap-12 px-12 cursor-pointer wrap group ">
                            <div
                                class="absolute left-0 h-[4.4rem] w-[0.8rem] line transition-all ease-in-out duration-300 group-hover:bg-secondary-color">
                            </div>
                            <i class="text-4xl w-[13%] text-white ti ti-logout-2"></i>
                            <p class="text-xl 3xl:text-2xl w-[77%]">Log Out</p>
                        </label>
                        <form action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                            <input type="submit" class="hidden" id="logout">
                        </form>
                    </div>
                </div>
            </div>
            {{-- Profile --}}
            <div class="overflow-hidden md:col-span-8 sideMenu-tabs-content rounded-2xl bg-secondary-accent-color">
                <div class="banner">
                    <img src="{{ asset('asset/Banner-profile.png') }}" alt="">
                </div>
                <div class="flex flex-col gap-4 p-4 md:p-6 3xl:p-12 body">
                    <div class="profile">
                        <p class="text-2xl">Profile</p>
                    </div>
                    <hr>
                    <form enctype="multipart/form-data" method="POST"
                        action="{{ Route('profile.update', Auth::user()->customer_ID) }}"
                        class="flex flex-col-reverse items-center w-full grid-cols-6 gap-8 my-3 md:gap-16 md:grid profile-wrap">
                        @csrf
                        @method('put')
                        <div class="flex flex-col w-full col-span-4 gap-3 md:gap-6 wrap">
                            <div class="flex flex-col items-center w-full text-white md:flex-row wrap">
                                <label for="username" class="text-lg md:w-[30%] w-full">Username</label>
                                <input name="username" id="username" type="text" placeholder="Max 20 Char"
                                    value="{{ Auth::user()->username ?? 'Not Set Username Yet' }}"
                                    class="md:w-[70%] w-full px-4 py-2 text-gray-500 rounded-lg">
                            </div>
                            <div class="flex flex-col items-center w-full text-white md:flex-row wrap">
                                <label for="email" class="text-lg md:w-[30%] w-full">Email</label>
                                <input name="email" id="email" type="text" placeholder="Email"
                                    value="{{ Auth::user()->email ?? 'Not Set Email Yet' }}"
                                    class="md:w-[70%] w-full px-4 py-2 text-gray-500 rounded-lg">
                            </div>
                            <div class="flex flex-col items-center w-full text-white md:flex-row wrap">
                                <label for="phone" class="text-lg md:w-[30%] w-full">Phone</label>
                                <input name="phone" id="phone" type="text" placeholder="Phone Number"
                                    value="{{ Auth::user()->phone ?? 'Not Set Phone Yet' }}"
                                    class="md:w-[70%] w-full px-4 py-2 text-gray-500 rounded-lg">
                            </div>
                            <button type="submit"
                                class="self-end w-full px-8 py-2 bg-green-600 rounded-lg md:w-fit">Update
                                Data</button>
                        </div>
                        <div class="flex justify-center w-full col-span-2">
                            <div class="flex flex-col items-center gap-6 wrap">
                                <img class="md:w-[8rem] w-[12rem] h-[12rem] md:h-[8rem] rounded-full object-cover img-preview"
                                    src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://salonlfc.com/wp-content/uploads/2018/01/image-not-found-1-scaled.png' }}"
                                    alt="Image Preview">
                                <input name="image" id="file" type="file" class="hidden file-img-product">
                                <label for="file"
                                    class="px-8 py-2 text-white rounded-lg cursor-pointer h-fit w-fit outline-1 outline outline-white">Pilih
                                    Gambar</label>
                                <p class="hidden text-red-500 error-message">File harus berupa gambar dengan format
                                    .JPEG, .PNG, atau .JPG</p>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div id="locations" class="flex items-center justify-between ">
                        <p class="text-base md:text-2xl">My Location <span class="text-highlight-content">(Max
                                2)</span> </p>
                        <button id="locationTrigger"
                            class="self-end px-4 py-2 text-sm bg-green-600 rounded-lg md:px-8 w-fit">Add
                            Location</button>
                    </div>
                    <div class="flex flex-col items-center w-full gap-6 my-3 location-wrap">
                        @if ($customer->locationCustomer->isNotEmpty())
                            @foreach ($customer->locationCustomer as $location)
                                <div
                                    class="w-full md:p-6 p-3 border-[2.5px] flex flex-col gap-3 border-red-800 rounded-lg
                                @if ($location->is_primary == 1) bg-secondary-color bg-opacity-40 @endif
                                location-box">
                                    <div class="w-full space-y-2 header">
                                        <button
                                            class="w-full px-8 py-2 text-sm rounded-full md:w-fit text-balance bg-primary-color text-highlight-content outline outline-1 outline-highlight-content">
                                            {{ $location->location_label }}
                                        </button>
                                        <p>{{ $location->reciver_name }} | ({{ $location->reciver_number }})</p>
                                    </div>
                                    <div class="flex flex-col justify-between gap-3 md:flex-row body">
                                        <div class="wrap md:w-[60%] w-full flex flex-col gap-3">
                                            <p>{{ $location->reciver_address }}</p>
                                            <div class="flex items-center w-full gap-3 wrap">
                                                <button
                                                    class="text-center md:w-[6rem] w-full py-1.5 bg-green-600 rounded-lg">Edit</button>
                                                <form
                                                    action="{{ Route('profile.location.delete', $location->location_ID) }}"
                                                    method="POST" class="w-full">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        class="text-center md:w-[6rem] w-full py-1.5 bg-red-500 rounded-lg">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="check-status flex  h-fit justify-end md:w-[40%] w-full text-end">
                                            @if ($location->is_primary == 1)
                                                <i
                                                    class="hidden text-2xl md:block text-secondary-color ti ti-check text-end"></i>
                                                <button
                                                    class="w-full px-8 py-2 text-center text-white rounded-lg md:w-fit md:hidden bg-secondary-accent-color">Location
                                                    Choose</button>
                                            @else
                                                <form
                                                    action="{{ Route('profile.location.primary', $location->location_ID) }}"
                                                    method="POST" class="flex justify-end w-full ">
                                                    @csrf
                                                    @method('put')
                                                    <button
                                                        class="hidden w-full px-8 py-2 text-white bg-green-600 rounded-lg text-end md:w-fit md:block">Choose</button>
                                                    <button
                                                        class="w-full px-8 py-2 text-white rounded-lg bg-primary-color md:hidden">Choose
                                                        Location</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-base md:text-xl">No location available</p>
                        @endif
                    </div>
                </div>
            </div>
            {{-- Order --}}
            <div class="overflow-hidden md:col-span-8 sideMenu-tabs-content rounded-2xl bg-secondary-accent-color">
                <div class="banner">
                    <img src="{{ asset('asset/Banner-profile.png') }}" alt="">
                </div>
                <div class="w-full p-4 space-y-3 md:p-6 3xl:p-8 body">
                    <div class="swiper">
                        <div class="w-full gap-4 button-profile-order">
                            <div class="swiper-wrapper p-0.5">
                                <label
                                    class="w-full px-6 py-2 text-base text-center text-white transition-all duration-300 ease-in-out rounded-lg cursor-pointer swiper-slide outline outline-2 outline-white hover:bg-secondary-color hover:outline-none tabs-toggle-order ">Paid</label>
                                <label
                                    class="w-full px-6 py-2 text-base text-center text-white transition-all duration-300 ease-in-out rounded-lg cursor-pointer swiper-slide outline outline-2 outline-white hover:bg-secondary-color hover:outline-none tabs-toggle-order ">Completed</label>
                                <label
                                    class="w-full px-6 py-2 text-base text-center text-white transition-all duration-300 ease-in-out rounded-lg cursor-pointer swiper-slide outline outline-2 outline-white hover:bg-secondary-color hover:outline-none tabs-toggle-order ">Canceled</label>
                                <label
                                    class="w-full px-6 py-2 text-base text-center text-white transition-all duration-300 ease-in-out rounded-lg cursor-pointer swiper-slide outline outline-2 outline-white hover:bg-secondary-color hover:outline-none tabs-toggle-order ">Serve</label>
                                <label
                                    class="w-full px-6 py-2 text-base text-center text-white transition-all duration-300 ease-in-out rounded-lg cursor-pointer swiper-slide outline outline-2 outline-white hover:bg-secondary-color hover:outline-none tabs-toggle-order ">Shipping</label>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-white tabs-content-order">
                        <div class="w-full swiper">
                            <div class="w-full p-1 profile-order-wrapper">
                                <div class="w-full swiper-wrapper">
                                    @foreach ($transactions as $transaction)
                                        @if ($transaction->status_order == 'paid')
                                            <div
                                                class="h-fit swiper-slide flex bg-primary-color flex-col items-center outline w-full md:w-[30rem] outline-highlight-content outline-1 gap-3 rounded-lg p-3">
                                                <div class="relative flex items-center w-full gap-8 wrap">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/4852/4852525.png"
                                                        class="md:w-[8rem] w-[6rem] h-[8rem] object-cover bg-secondary-accent-color rounded-md"
                                                        alt="">
                                                    <div class="flex flex-col w-full gap-1.5 wrap md:flex-row">
                                                        <div class="flex flex-col w-full gap-1 detail-wrap">
                                                            <!-- Total Items -->
                                                            <p>Total ({{ $transaction->total_items }} Items)</p>
                                                            <!-- Total Amount -->
                                                            <p>Rp
                                                                {{ number_format($transaction->total_amounts, 0, ',', '.') }}
                                                            </p>
                                                        </div>
                                                        <div class="flex w-full md:px-3 md:justify-end wrap">
                                                            <!-- Order Status -->
                                                            <label
                                                                class="px-8 py-2 text-sm text-center bg-purple-500 rounded-lg md:rounded-full w-fit h-fit">
                                                                {{ ucfirst($transaction->status_order) }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="{{ Route('tracking.view', $transaction->order_ID ?? '') }}"
                                                    class="w-full px-4 py-2 font-medium text-center rounded-md bg-secondary-accent-color text-highlight-content">
                                                    See Details
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-white tabs-content-order">
                        <div class="swiper">
                            <div class="p-1 profile-order-wrapper">
                                <div class="w-full swiper-wrapper">
                                    @foreach ($transactions as $transaction)
                                        @if ($transaction->status_order == 'completed')
                                            <div
                                                class="h-fit swiper-slide flex bg-primary-color flex-col items-center outline w-full md:w-[30rem] outline-highlight-content outline-1 gap-3 rounded-lg p-3">
                                                <div class="relative flex items-center w-full gap-8 wrap">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/4852/4852525.png"
                                                        class="md:w-[8rem] w-[6rem] h-[8rem]  object-cover bg-secondary-accent-color rounded-md"
                                                        alt="">
                                                    <div class="flex flex-col w-full gap-1.5 wrap md:flex-row">
                                                        <div class="flex flex-col w-full gap-1 detail-wrap">
                                                            <!-- Total Items -->
                                                            <p>Total ({{ $transaction->total_items }} Items)</p>
                                                            <!-- Total Amount -->
                                                            <p>Rp
                                                                {{ number_format($transaction->total_amounts, 0, ',', '.') }}
                                                            </p>
                                                        </div>
                                                        <div class="flex w-full md:px-3 md:justify-end wrap">
                                                            <!-- Order Status -->
                                                            <label for=""
                                                                class="px-8 py-2 text-sm text-center text-white bg-green-500 rounded-lg md:rounded-full w-fit md:w-fit h-fit">
                                                                {{ $transaction->status_order }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="{{ Route('tracking.view', $transaction->order_ID ?? '') }}"
                                                    class="w-full px-4 py-2 font-medium text-center rounded-md bg-secondary-accent-color text-highlight-content">
                                                    See Details
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-white tabs-content-order">
                        <div class="swiper">
                            <div class="p-1 profile-order-wrapper">
                                <div class="w-full swiper-wrapper">
                                    @foreach ($transactions as $transaction)
                                        @if ($transaction->status_order == 'canceled')
                                            <div
                                                class="h-fit swiper-slide flex bg-primary-color flex-col items-center outline w-full md:w-[30rem] outline-highlight-content outline-1 gap-3 rounded-lg p-3">
                                                <div class="relative flex items-center w-full gap-8 wrap">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/4852/4852525.png"
                                                        class="md:w-[8rem] w-[6rem] h-[8rem]  object-cover bg-secondary-accent-color rounded-md"
                                                        alt="">
                                                    <div class="flex flex-col w-full gap-1.5 wrap md:flex-row">
                                                        <div class="flex flex-col w-full gap-1 detail-wrap">
                                                            <!-- Total Items -->
                                                            <p>Total ({{ $transaction->total_items }} Items)</p>
                                                            <!-- Total Amount -->
                                                            <p>Rp
                                                                {{ number_format($transaction->total_amounts, 0, ',', '.') }}
                                                            </p>
                                                        </div>
                                                        <div class="flex w-full md:px-3 md:justify-end wrap">
                                                            <!-- Order Status -->
                                                            <label for=""
                                                                class="px-8 py-2 text-sm text-center text-white rounded-lg bg-secondary-color md:rounded-full w-fit md:w-fit h-fit">
                                                                {{ $transaction->status_order }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="{{ Route('tracking.view', $transaction->order_ID ?? '') }}"
                                                    class="w-full px-4 py-2 font-medium text-center rounded-md bg-secondary-accent-color text-highlight-content">
                                                    See Details
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-white tabs-content-order">
                        <div class="swiper">
                            <div class="p-1 profile-order-wrapper">
                                <div class="w-full swiper-wrapper">
                                    @foreach ($transactions as $transaction)
                                        @if ($transaction->status_order == 'serve')
                                            <div
                                                class="h-fit swiper-slide flex bg-primary-color flex-col items-center outline w-full md:w-[30rem] outline-highlight-content outline-1 gap-3 rounded-lg p-3">
                                                <div class="relative flex items-center w-full gap-8 wrap">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/4852/4852525.png"
                                                        class="md:w-[8rem] w-[6rem] h-[8rem]  object-cover bg-secondary-accent-color rounded-md"
                                                        alt="">
                                                    <div class="flex flex-col w-full gap-1.5 wrap md:flex-row">
                                                        <div class="flex flex-col w-full gap-1 detail-wrap">
                                                            <!-- Total Items -->
                                                            <p>Total ({{ $transaction->total_items }} Items)</p>
                                                            <!-- Total Amount -->
                                                            <p>Rp
                                                                {{ number_format($transaction->total_amounts, 0, ',', '.') }}
                                                            </p>
                                                        </div>
                                                        <div class="flex w-full md:px-3 md:justify-end wrap">
                                                            <!-- Order Status -->
                                                            <label for=""
                                                                class="px-8 py-2 text-sm text-center text-white bg-teal-500 rounded-lg md:rounded-full w-fit md:w-fit h-fit">
                                                                {{ $transaction->status_order }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="{{ Route('tracking.view', $transaction->order_ID ?? '') }}"
                                                    class="w-full px-4 py-2 font-medium text-center rounded-md bg-secondary-accent-color text-highlight-content">
                                                    See Details
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-white tabs-content-order">
                        <div class="swiper">
                            <div class="p-1 profile-order-wrapper">
                                <div class="w-full swiper-wrapper">
                                    @foreach ($transactions as $transaction)
                                        @if ($transaction->status_order == 'shipped')
                                            <div
                                                class="h-fit swiper-slide flex bg-primary-color flex-col items-center outline w-full md:w-[30rem] outline-highlight-content outline-1 gap-3 rounded-lg p-3">
                                                <div class="relative flex items-center w-full gap-8 wrap">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/4852/4852525.png"
                                                        class="md:w-[8rem] w-[6rem] h-[8rem]  object-cover bg-secondary-accent-color rounded-md"
                                                        alt="">
                                                    <div class="flex flex-col w-full gap-1.5 wrap md:flex-row">
                                                        <div class="flex flex-col w-full gap-1 detail-wrap">
                                                            <!-- Total Items -->
                                                            <p>Total ({{ $transaction->total_items }} Items)</p>
                                                            <!-- Total Amount -->
                                                            <p>Rp
                                                                {{ number_format($transaction->total_amounts, 0, ',', '.') }}
                                                            </p>
                                                        </div>
                                                        <div class="flex w-full md:px-3 md:justify-end wrap">
                                                            <!-- Order Status -->
                                                            <label for=""
                                                                class="px-8 py-2 text-sm text-center text-white bg-indigo-500 rounded-lg md:rounded-full w-fit md:w-fit h-fit">
                                                                {{ $transaction->status_order }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="{{ Route('tracking.view', $transaction->order_ID ?? '') }}"
                                                    class="w-full px-4 py-2 font-medium text-center rounded-md bg-secondary-accent-color text-highlight-content">
                                                    See Details
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Wishlist --}}
            <div
                class="gap-6 overflow-hidden md:col-span-8 sideMenu-tabs-content rounded-2xl bg-secondary-accent-color">
                <div class="banner">
                    <img src="{{ asset('asset/Banner-profile.png') }}" alt="">
                </div>
                <div class="w-full gap-6 p-3 space-y-4 md:p-8 body">
                    <div class="flex items-center justify-between location">
                        <p class="text-xl uppercase md:text-2xl">my wishlist </p>
                        <button id="clearAll"
                            class="self-end px-4 py-2 text-base transition-all duration-300 ease-in-out rounded-lg md:px-8 md:text-lg hover:outline-none outline-1 outline hover:bg-secondary-color w-fit">CLEAR
                            ALL</button>
                    </div>
                    <div class="swiper">
                        <div class="p-1 whislist-swiper">
                            <div class="w-full swiper-wrapper">
                                <!-- Card Menu -->
                                @foreach ($menusFav as $menu)
                                    <div
                                        class="swiper-slide outline outline-2 outline-highlight-content relative transition-all duration-300 ease-in-out card-wrapper rounded-2xl w-[23rem] h-fit bg-primary-color">
                                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                            class="md:h-[200px] h-[140px] w-full text-white rounded-t-2xl object-cover object-center" />
                                        <div class="flex flex-col md:h-[11rem] h-[9rem] gap-4 p-5 content">
                                            <div class="flex flex-col gap-2 wrap-desc">
                                                <p class="text-xl line-clamp-1">
                                                    {{ $menu->name }}
                                                </p>
                                                <p
                                                    class="text-base text-justify font-aesthetnova md:line-clamp-2 line-clamp-1">
                                                    {{ $menu->menu_description }}
                                                </p>
                                            </div>
                                            <div class="flex items-center justify-between mt-auto wrap-price">
                                                {{-- Menampilkan harga berdasarkan ukuran 'sm' --}}
                                                @php
                                                    // Mencari property dengan size 'sm'
                                                    $property = $menu->properties->firstWhere('size', 'sm');
                                                @endphp
                                                @if ($property)
                                                    <p class="text-xl md:text-xl">
                                                        Rp {{ number_format($property->price, 0, ',', '.') }}
                                                    </p>
                                                @else
                                                    <p class="text-xl md:text-2xl">Price Not Available</p>
                                                @endif
                                                <div class="flex items-center md:gap-2 gap-1.5 wrap">
                                                    <a href="{{ Route('frontend.menu.details', $menu->menu_ID ?? '') }}"
                                                        class="px-6 py-1 text-base rounded-lg md:px-8 md:py-1.5 bg-secondary-color">Details</a>
                                                    <button data-menu-id="{{ $menu->menu_ID }}"
                                                        class="px-2 md:h-[2.2rem] h-[2rem] flex items-center text-base rounded-lg cursor-pointer md:px-3 outline outline-2 outline-secondary-color transition-all ease-in-out duration-500 hover:bg-secondary-color">
                                                        <i class="text-xl ti ti-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- Card Menu End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Review Box Wrapper -->
    @include('layout.modal.modal-location')
    @include('layout.Sidebar')
    @include('layout.Footer')
</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="{{ asset('/js/swiper.js') }}"></script>
<script src="{{ asset('/js/GSAP.js') }}"></script>
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<script src="{{ asset('/js/sidebar.js') }}"></script>
<script src="{{ asset('/js/tabs-order.js') }}"></script>
<script src="{{ asset('/js/tabs-profile.js') }}"></script>
<script src="{{ asset('/js/boxLogin.js') }}"></script>
<script src="{{ asset('/js/imgPicker.js') }}"></script>
<script>
    const locationTrigger = document.getElementById("locationTrigger"),
        locationBox = document.getElementById("locationBox"),
        closelocation = document.getElementById("closelocation");

    locationTrigger.addEventListener("click", () => {
        locationTrigger.classList.add("trigger-active-location");
        locationBox.classList.add("box-active-location");
    });

    closelocation.addEventListener("click", () => {
        locationTrigger.classList.remove("trigger-active-location");
        locationBox.classList.remove("box-active-location");
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Seleksi semua tombol dengan atribut data-menu-id
        const favoriteButtons = document.querySelectorAll("button[data-menu-id]");

        favoriteButtons.forEach((button) => {
            button.addEventListener("click", async () => {
                const menuID = button.getAttribute("data-menu-id");
                const csrfToken = document.querySelector('meta[name="csrf-token"]')
                    .getAttribute("content");

                try {
                    // Kirim permintaan ke endpoint dengan metode DELETE
                    const response = await fetch(`/favorite-menu/remove/${menuID}`, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                    });

                    const data = await response.json();
                    if (response.ok) {
                        // Menampilkan pemberitahuan sukses menggunakan Notyf
                        notyf.success(data.message || "Perubahan favorit berhasil!");

                        // Hapus elemen card-wrapper terkait
                        const cardWrapper = button.closest(".card-wrapper");
                        if (cardWrapper) {
                            cardWrapper.remove();
                        }
                    } else {
                        // Menampilkan pemberitahuan error menggunakan Notyf
                        notyf.error(data.message ||
                            "Terjadi kesalahan, silakan coba lagi.");
                    }
                } catch (error) {
                    console.error("Error:", error);
                    // Menampilkan pemberitahuan error jika terjadi kesalahan jaringan
                    notyf.error(
                        "Gagal memproses favorit. Periksa koneksi Anda dan coba lagi.");
                }
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const clearAllButton = document.getElementById("clearAll");

        clearAllButton.addEventListener("click", async () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                "content");

            if (confirm("Are you sure you want to clear all favorite menus?")) {
                try {
                    const response = await fetch(`/favorite-menu/clear-all`, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                    });

                    const data = await response.json();

                    if (response.ok) {
                        // Menampilkan pemberitahuan sukses menggunakan Notyf
                        notyf.success(data.message || "All favorites cleared");

                        // Menghapus semua elemen card-wrapper dari DOM
                        const cardWrappers = document.querySelectorAll(".card-wrapper");
                        cardWrappers.forEach((card) => card.remove());
                    } else {
                        // Menampilkan pemberitahuan error menggunakan Notyf
                        notyf.error(data.message || "Failed to clear favorites!");
                    }
                } catch (error) {
                    console.error("Error:", error);
                    notyf.error("Failed to clear favorites. Please try again.");
                }
            }
        });
    });
</script>



</html>
