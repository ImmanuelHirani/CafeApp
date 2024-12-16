<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    @vite('resources/css/app.css')
</head>

<body id="Admin">
    @include('layout.header')
    <main class="grid grid-cols-7 gap-4 py-4">
        <section class="flex flex-col col-span-5 p-6 rounded-lg gap-9 bg-primary-color-admin">
            <!-- Header Content -->
            <div class="flex items-center justify-between header">
                <p class="text-2xl font-semibold">Menus</p>
                <div class="flex items-center gap-3 wrap">
                    {{-- <div class="relative w-full max-w-xs">
                        <input type="search" placeholder="Search Product"
                            class="w-full p-3 pl-10 rounded-full outline-none bg-secondary-accent-color-admin" />
                        <img src="{{ asset('asset/SVG/search-icon-admin.svg') }}" alt="Search Icon"
                            class="absolute w-5 h-5 transform -translate-y-1/2 left-3 top-1/2" />
                    </div> --}}
                    <button id="btn-add-product"
                        class="flex items-center group transition-all ease-in-out duration-300 hover:bg-secondary-accent-color
hover:!text-white gap-3  justify-center py-3 h-10 px-4  w-full outline outline-2 outline-accent-color-admin rounded-full !text-accent-color-admin">
                        Add New Menu
                        <i class="ti ti-plus group-hover:!text-white !text-accent-color-admin text-xl"></i>
                    </button>
                </div>
            </div>
            <!-- Header Content end -->
            <!-- quick link tab -->
            <div class="flex items-center justify-between w-full text-lg !text-secondary-accent-color wrap-quickTab">
                <button
                    class="relative z-10 flex  items-center gap-2 3xl:px-5 px-3.5 py-2 font-semibold transition-all duration-300 ease-in-out tabs-toggle-product wrap group">
                    <i class="text-2xl ti ti-box"></i>
                    All Products
                </button>
                <button
                    class="relative z-10 flex items-center gap-2 3xl:px-5 px-3.5 py-2 font-semibold transition-all duration-300 ease-in-out tabs-toggle-product wrap group">
                    <i class="text-2xl ti ti-ad-2"></i>
                    Most Purchase
                </button>
                <button
                    class="relative z-10 flex items-center gap-2 3xl:px-5 px-3.5 py-2 font-semibold transition-all duration-300 ease-in-out tabs-toggle-product wrap group">
                    <i class="text-2xl ti ti-writing"></i>
                    Best Rating
                </button>
                <button
                    class="relative z-10 flex items-center gap-2 3xl:px-5 px-3.5 py-2 font-semibold transition-all duration-300 ease-in-out tabs-toggle-product wrap group">
                    <i class="text-2xl ti ti-pizza"></i>
                    Pizza
                </button>
                <button
                    class="relative z-10 flex items-center gap-2 3xl:px-5 px-3.5 py-2 font-semibold transition-all duration-300 ease-in-out tabs-toggle-product wrap group">
                    <i class="text-2xl ti ti-coffee"></i>
                    Coffee
                </button>
                <button
                    class="relative z-10 flex items-center gap-2 3xl:px-5 px-3.5 py-2 font-semibold transition-all duration-300 ease-in-out tabs-toggle-product wrap group">
                    <i class="text-2xl ti ti-bubble-tea"></i>
                    Bubble ice
                </button>
            </div>
            <!-- quick link tab end -->
            <!-- Main Content Card -->
            <div class="flex flex-col h-full gap-6 wrap">
                <!-- All product -->
                <div class="grid grid-cols-3 gap-4 tabs-content-product 3xl:grid-cols-4 auto-rows-auto">
                    @foreach ($menus as $menu)
                        <div class="relative p-3 overflow-hidden rounded-lg cursor-pointer card h-fit outline outline-2 outline-accent-color-admin"
                            onclick="window.location.href='/admin/product/detail/{{ $menu->menu_ID }}'">
                            <div class="relative overflow-hidden rounded-lg head-img">
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                    class="object-cover w-full h-[13em]" />
                                <form onclick="confirmation(event)"
                                    action="{{ route('delete.menu', $menu->menu_ID ?? '') }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button id="trash" type="submit" class="absolute bottom-5 right-3">
                                        <i class="p-2.5 text-lg bg-red-500 !text-white rounded-full ti ti-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @if ($menu->is_active == 1)
                                <div
                                    class="absolute w-4 h-4 bg-green-500 border-2 border-white rounded-full animate-pulse top-4 right-4 dot-status">
                                </div>
                            @else
                                <div
                                    class="absolute w-4 h-4 bg-red-500 border-2 border-white rounded-full animate-pulse top-4 right-4 dot-status">
                                </div>
                            @endif
                            <div class="flex flex-col h-[8rem] gap-6 wrap-body">
                                <div class="mt-2 text-lg body-card">
                                    <p class="font-medium line-clamp-1">{{ $menu->name }}</p>
                                    @php
                                        // Mencari property dengan size 'sm'
                                        $property = $menu->properties->firstWhere('size', 'xl');
                                    @endphp
                                    @if ($property)
                                        <p class="font-medium">
                                            Rp
                                            {{ number_format($property->price, 0, ',', '.') }}
                                        </p>
                                    @else
                                        <p class="text-xl md:text-2xl">Price Not Available</p>
                                    @endif
                                </div>
                                <div class="flex justify-between mt-auto footer-card">
                                    <div class="inline-flex gap-3 stock">
                                        <p class="!text-accent-color-admin">Stock</p>
                                        <p class="font-semibold">{{ $menu->stock }}</p>
                                    </div>
                                    <div class="inline-flex gap-3 categories">
                                        <p class="!text-accent-color-admin">Categories</p>
                                        <p class="font-semibold">{{ ucfirst($menu->menu_type) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Most Purchase -->
                <div class="grid grid-cols-3 gap-4 tabs-content-product 3xl:grid-cols-4 auto-rows-auto">
                    @foreach ($menus as $menu)
                        <div class="relative p-3 overflow-hidden rounded-lg cursor-pointer card h-fit outline outline-2 outline-accent-color-admin"
                            onclick="window.location.href='/admin/product/detail/{{ $menu->menu_ID }}'">
                            <div class="relative overflow-hidden rounded-lg head-img">
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                    class="object-cover w-full h-[13em]" />
                                <form onclick="confirmation(event)"
                                    action="{{ route('delete.menu', $menu->menu_ID ?? '') }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button id="trash" type="submit" class="absolute bottom-5 right-3">
                                        <i class="p-2.5 text-lg bg-red-500 !text-white rounded-full ti ti-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @if ($menu->is_active == 1)
                                <div
                                    class="absolute w-4 h-4 bg-green-500 border-2 border-white rounded-full animate-pulse top-4 right-4 dot-status">
                                </div>
                            @else
                                <div
                                    class="absolute w-4 h-4 bg-red-500 border-2 border-white rounded-full animate-pulse top-4 right-4 dot-status">
                                </div>
                            @endif
                            <div class="flex flex-col h-[8rem] gap-6 wrap-body">
                                <div class="mt-2 text-lg body-card">
                                    <p class="font-medium">{{ $menu->name }}</p>
                                    <p class="!text-accent-color-admin">Rp.
                                        {{ number_format($menu->price, 0, ',', '.') }}</p>

                                </div>
                                <div class="flex justify-between mt-auto footer-card">
                                    <div class="inline-flex gap-3 stock">
                                        <p class="!text-accent-color-admin">Stock</p>
                                        <p class="font-semibold">{{ $menu->stock }}</p>
                                    </div>
                                    <div class="inline-flex gap-3 categories">
                                        <p class="!text-accent-color-admin">Categories</p>
                                        <p class="font-semibold">{{ ucfirst($menu->menu_type) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Best Rating -->
                <div class="grid grid-cols-3 gap-4 tabs-content-product 3xl:grid-cols-4 auto-rows-auto">
                    @foreach ($menus as $menu)
                        <div class="relative p-3 overflow-hidden rounded-lg cursor-pointer card h-fit outline outline-2 outline-accent-color-admin"
                            onclick="window.location.href='/admin/product/detail/{{ $menu->menu_ID }}'">
                            <div class="relative overflow-hidden rounded-lg head-img">
                                <img src="{{ asset('storage/' . $menu->image) }}"
                                    alt="{{ $menu->name }}"class="object-cover w-full h-[13em]" />
                                <form onclick="confirmation(event)"
                                    action="{{ route('delete.menu', $menu->menu_ID ?? '') }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button id="trash" type="submit" class="absolute bottom-5 right-3">
                                        <i class="p-2.5 text-lg bg-red-500 !text-white rounded-full ti ti-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @if ($menu->is_active == 1)
                                <div
                                    class="absolute w-4 h-4 bg-green-500 border-2 border-white rounded-full animate-pulse top-4 right-4 dot-status">
                                </div>
                            @else
                                <div
                                    class="absolute w-4 h-4 bg-red-500 border-2 border-white rounded-full animate-pulse top-4 right-4 dot-status">
                                </div>
                            @endif
                            <div class="flex flex-col h-[8rem] gap-6 wrap-body">
                                <div class="mt-2 text-lg body-card">
                                    <p class="font-medium">{{ $menu->name }}</p>
                                    <p class="!text-accent-color-admin">Rp.
                                        {{ number_format($menu->price, 0, ',', '.') }}</p>

                                </div>
                                <div class="flex justify-between mt-auto footer-card">
                                    <div class="inline-flex gap-3 stock">
                                        <p class="!text-accent-color-admin">Stock</p>
                                        <p class="font-semibold">{{ $menu->stock }}</p>
                                    </div>
                                    <div class="inline-flex gap-3 categories">
                                        <p class="!text-accent-color-admin">Categories</p>
                                        <p class="font-semibold">{{ ucfirst($menu->menu_type) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pizza -->
                <div class="grid grid-cols-3 gap-4 tabs-content-product 3xl:grid-cols-4 auto-rows-auto">
                    @foreach ($menus as $menu)
                        @if ($menu->menu_type == 'pizza')
                            <div class="relative p-3 overflow-hidden rounded-lg cursor-pointer card h-fit outline outline-2 outline-accent-color-admin"
                                onclick="window.location.href='/admin/product/detail/{{ $menu->menu_ID }}'">
                                <div class="relative overflow-hidden rounded-lg head-img">
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                        class="object-cover w-full h-[13em]" />
                                    <form onclick="confirmation(event)"
                                        action="{{ route('delete.menu', $menu->menu_ID ?? '') }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button id="trash" type="submit" class="absolute bottom-5 right-3">
                                            <i
                                                class="p-2.5 text-lg bg-red-500 !text-white rounded-full ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                @if ($menu->is_active == 1)
                                    <div
                                        class="absolute w-4 h-4 bg-green-500 border-2 border-white rounded-full animate-pulse top-4 right-4 dot-status">
                                    </div>
                                @else
                                    <div
                                        class="absolute w-4 h-4 bg-red-500 border-2 border-white rounded-full animate-pulse top-4 right-4 dot-status">
                                    </div>
                                @endif
                                <div class="flex flex-col h-[8rem] gap-6 wrap-body">
                                    <div class="mt-2 text-lg body-card">
                                        <p class="font-medium">{{ $menu->name }}</p>
                                        <p class="!text-accent-color-admin">Rp.
                                            {{ number_format($menu->price, 0, ',', '.') }}</p>

                                    </div>
                                    <div class="flex justify-between mt-auto footer-card">
                                        <div class="inline-flex gap-3 stock">
                                            <p class="!text-accent-color-admin">Stock</p>
                                            <p class="font-semibold">{{ $menu->stock }}</p>
                                        </div>
                                        <div class="inline-flex gap-3 categories">
                                            <p class="!text-accent-color-admin">Categories</p>
                                            <p class="font-semibold">{{ ucfirst($menu->menu_type) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- Coffee -->
                <div class="grid grid-cols-3 gap-4 tabs-content-product 3xl:grid-cols-4 auto-rows-auto">
                    @foreach ($menus as $menu)
                        @if ($menu->menu_type == 'coffee')
                            <div class="relative p-3 overflow-hidden rounded-lg cursor-pointer card h-fit outline outline-2 outline-accent-color-admin"
                                onclick="window.location.href='/admin/product/detail/{{ $menu->menu_ID }}'">
                                <div class="relative overflow-hidden rounded-lg head-img">
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                        class="object-cover w-full h-[13em]" />
                                    <form onclick="confirmation(event)"
                                        action="{{ route('delete.menu', $menu->menu_ID ?? '') }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button id="trash" type="submit" class="absolute bottom-5 right-3">
                                            <i
                                                class="p-2.5 text-lg bg-red-500 !text-white rounded-full ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                @if ($menu->is_active == 1)
                                    <div
                                        class="absolute w-4 h-4 bg-green-500 border-2 border-white rounded-full animate-pulse top-4 right-4 dot-status">
                                    </div>
                                @else
                                    <div
                                        class="absolute w-4 h-4 bg-red-500 border-2 border-white rounded-full animate-pulse top-4 right-4 dot-status">
                                    </div>
                                @endif
                                <div class="flex flex-col h-[8rem] gap-6 wrap-body">
                                    <div class="mt-2 text-lg body-card">
                                        <p class="font-medium">{{ $menu->name }}</p>
                                        <p class="!text-accent-color-admin">Rp.
                                            {{ number_format($menu->price, 0, ',', '.') }}</p>

                                    </div>
                                    <div class="flex justify-between mt-auto footer-card">
                                        <div class="inline-flex gap-3 stock">
                                            <p class="!text-accent-color-admin">Stock</p>
                                            <p class="font-semibold">{{ $menu->stock }}</p>
                                        </div>
                                        <div class="inline-flex gap-3 categories">
                                            <p class="!text-accent-color-admin">Categories</p>
                                            <p class="font-semibold">{{ ucfirst($menu->menu_type) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- Bubble -->
                <div class="grid grid-cols-3 gap-4 tabs-content-product 3xl:grid-cols-4 auto-rows-auto">
                    @foreach ($menus as $menu)
                        @if ($menu->menu_type == 'bobba')
                            <div class="relative p-3 overflow-hidden rounded-lg cursor-pointer card h-fit outline outline-2 outline-accent-color-admin"
                                onclick="window.location.href='/admin/product/detail/{{ $menu->menu_ID }}'">
                                <div class="relative overflow-hidden rounded-lg head-img">
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                        class="object-cover w-full h-[13em]" />
                                    <form onclick="confirmation(event)"
                                        action="{{ route('delete.menu', $menu->menu_ID ?? '') }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button id="trash" type="submit" class="absolute bottom-5 right-3">
                                            <i
                                                class="p-2.5 text-lg bg-red-500 !text-white rounded-full ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                @if ($menu->is_active == 1)
                                    <div
                                        class="absolute w-4 h-4 bg-green-500 border-2 border-white rounded-full animate-pulse top-4 right-4 dot-status">
                                    </div>
                                @else
                                    <div
                                        class="absolute w-4 h-4 bg-red-500 border-2 border-white rounded-full animate-pulse top-4 right-4 dot-status">
                                    </div>
                                @endif
                                <div class="flex flex-col h-[8rem] gap-6 wrap-body">
                                    <div class="mt-2 text-lg body-card">
                                        <p class="font-medium">{{ $menu->name }}</p>
                                        <p class="!text-accent-color-admin">Rp.
                                            {{ number_format($menu->price, 0, ',', '.') }}</p>

                                    </div>
                                    <div class="flex justify-between mt-auto footer-card">
                                        <div class="inline-flex gap-3 stock">
                                            <p class="!text-accent-color-admin">Stock</p>
                                            <p class="font-semibold">{{ $menu->stock }}</p>
                                        </div>
                                        <div class="inline-flex gap-3 categories">
                                            <p class="!text-accent-color-admin">Categories</p>
                                            <p class="font-semibold">{{ ucfirst($menu->menu_type) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- Pagination -->
                <div class="flex items-center justify-between mt-auto footer-content-paging">
                    <p class="text-base !text-accent-color-admin reasult-paggination"></p>
                    <div class="flex items-center gap-2 mt-auto pagination-container">
                        <!-- Page numbers and navigation buttons will be dynamically inserted here -->
                        <div class="flex items-center gap-2 page-numbers"></div>
                    </div>
                </div>
                <!-- Pagination end -->
            </div>
            <!-- Main Content Card end -->
        </section>
        @include('layout.Aside')
        @include('layout.modal.modal-product')
    </main>
</body>
<script src="{{ asset('/js/table.js') }}"></script>
<script src="{{ asset('/js/selectedStatus.js') }}"></script>
<script src="{{ asset('/js/imgPicker.js') }}"></script>
<script src="{{ asset('/js/tabs-menu.js') }}"></script>
<script src="{{ asset('/js/modal.js') }}"></script>
<script src="{{ asset('/js/pagginationPage.js') }}"></script>
<script src="{{ asset('/js/tabs-sideMenu.js') }}"></script>
<script>
    function confirmation(ev) {
        ev.preventDefault(); // Mencegah pengiriman form default
        ev.stopPropagation(); // Mencegah event bubbling ke parent (div)

        const form = ev.currentTarget; // Mengambil elemen form yang memicu event
        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, kirim form
                form.submit();
            }
        });
    }
</script>

</html>
