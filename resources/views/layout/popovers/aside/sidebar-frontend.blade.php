<div id="sidebarCart"
    class="fixed inset-0 z-50 flex items-center justify-end transition-all duration-[400ms] ease-linear translate-x-full font-aesthetnova">
    <div class="flex w-full h-full max-w-3xl">
        <!-- Others Also Bought Section -->
        <div class="md:w-[38%] md:block hidden bg-[#090E1A] bg-opacity-85">
            <h6 class="mt-8 mb-4 font-semibold text-center">
                OTHERS ALSO BOUGHT
            </h6>
            <div class="swiper">
                <div class="px-4 pt-2 pb-8 3xl:max-h-[52.5rem] 2xl:max-h-[39rem] xl:max-h-[43em] other-item-content">
                    <div class="swiper-wrapper">
                        <!-- Repeat this block for each item -->
                        @foreach ($menus as $menu)
                            <div class="swiper-slide">
                                <div
                                    class="flex flex-col items-center w-full rounded-lg shadow-xl bg-secondary-accent-color max-h-fit outline outline-1 outline-highlight-content">
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                        class="rounded-t-lg h-[180px] w-full object-cover" />
                                    <div class="flex items-center justify-between w-full gap-6 p-4 wrap">
                                        <div class="flex flex-col w-[80%]">
                                            <p class="text-xl line-clamp-1">
                                                {{ $menu->name }}
                                            </p>
                                            @php
                                                // Mencari property dengan size 'sm'
                                                $property = $menu->properties->firstWhere('size', 'sm');
                                            @endphp
                                            @if ($property)
                                                <p class="text-lg text-gray-300">
                                                    Rp
                                                    {{ number_format($property->price, 0, ',', '.') }}
                                                </p>
                                            @else
                                                <p class="text-xl md:text-2xl">Rp 0</p>
                                            @endif

                                        </div>
                                        <form class="w-[20%]"
                                            action="{{ Route('frontend.menu.details', $menu->menu_ID ?? '') }}"
                                            method="POST">
                                            @method('get')
                                            @csrf
                                            <button class="w-10 h-10 bg-white rounded-full text-secondary-color">
                                                <i class="text-2xl ti ti-shopping-cart-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <hr />
            <div class="w-full swiper">
                <div
                    class="my-2 3xl:max-h-[670px] 2xl:max-h-[470px] xl:max-h-[31em] max-h-[27em] sm:max-h-[38em] w-full cart-added-content overflow-hidden">
                    <!-- Repeat this block for each cart item -->
                    <div class="h-fit swiper-wrapper">
                        @forelse ($cartItems as $item)
                            @if ($item->order_type == 'normal_menu')
                                <!-- Tampilkan konten untuk normal menu -->
                                <div class="swiper-slide">
                                    <div
                                        class="flex flex-col items-center p-0.5 md:flex-row gap-x-6 md:gap-y-0 gap-y-3">
                                        <div class="wrap w-[30rem]">
                                            <img src="{{ asset('storage/' . $item->menu->image) }}"
                                                alt="{{ $item->menu->name }}"
                                                class="object-cover w-full rounded-lg h-44 md:w-full md:h-[13rem]" />
                                        </div>
                                        <div class="flex-col hidden w-full gap-2 md:flex md:gap-3 text-wrap">
                                            <p class="text-xl font-semibold md:text-xl line-clamp-1">
                                                {{ $item->menu_name }}
                                            </p>
                                            <p class="text-xl uppercase md:text-lg text-highlight-content">
                                                Size : {{ $item->size }}
                                            </p>
                                            <div class="flex items-center gap-3 wrap ">
                                                <form action="{{ route('cart.update', $item->transaction_ID) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div
                                                        class="flex items-center justify-center gap-8 px-4 py-1.5 rounded-full w-fit outline outline-1 outline-white">
                                                        <button type="button" class="decrease-btn"
                                                            data-id="{{ $item->transaction_detail_ID }}">
                                                            <i class="ti ti-minus"></i>
                                                        </button>
                                                        <span class="text-base md:text-lg text-accent-color"
                                                            id="quantity-{{ $item->transaction_detail_ID }}">
                                                            {{ $item->quantity }}
                                                        </span>
                                                        <button type="button" class="increase-btn"
                                                            data-id="{{ $item->transaction_detail_ID }}">
                                                            <i class="ti ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                                <form action="{{ route('delete.cart', $item->transaction_ID) }}"
                                                    method="POST" class="delete-form">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button"
                                                        class="flex items-center justify-center p-1.5 rounded-full bg-secondary-color delete-cart-item"
                                                        data-id="{{ $item->transaction_detail_ID }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                            fill="none" viewBox="0 0 26 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="flex items-center justify-between wrap">
                                                <p class="text-xl md:text-lg"
                                                    id="subtotal-{{ $item->transaction_detail_ID }}">
                                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="w-full space-y-2 md:hidden wrap-mobile">
                                            <p class="text-xl font-medium line-clamp-1">
                                                {{ $item->menu_name }}
                                            </p>
                                            <div class="flex items-center wrap ">
                                                <div class="flex-col w-full gap-2 md:hidden md:gap-3 text-wrap">
                                                    <p class="text-xl uppercase md:text-lg text-highlight-content">
                                                        Size : {{ $item->size }}
                                                    </p>
                                                    <div class="flex items-center justify-between wrap">
                                                        <p class="text-xl md:text-lg"
                                                            id="subtotal-mobile{{ $item->transaction_detail_ID }}">
                                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-2 wrap">
                                                    <form action="{{ route('cart.update', $item->transaction_ID) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div
                                                            class="flex items-center justify-center gap-8 px-3 py-1.5 rounded-full w-fit outline outline-1 outline-white">
                                                            <button type="button" class="decrease-btn"
                                                                data-id="{{ $item->transaction_detail_ID }}">
                                                                <i class="ti ti-minus"></i>
                                                            </button>
                                                            <span class="text-base md:text-lg text-accent-color"
                                                                id="quantity-mobile{{ $item->transaction_detail_ID }}">
                                                                {{ $item->quantity }}
                                                            </span>
                                                            <button type="button" class="increase-btn"
                                                                data-id="{{ $item->transaction_detail_ID }}">
                                                                <i class="ti ti-plus"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <form action="{{ route('delete.cart', $item->transaction_ID) }}"
                                                        method="POST" class="delete-form">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button"
                                                            class="flex items-center justify-center p-1.5 rounded-full bg-secondary-color delete-cart-item"
                                                            data-id="{{ $item->transaction_detail_ID }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                                fill="none" viewBox="0 0 26 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($item->order_type == 'custom_menu')
                                <!-- Tampilkan konten untuk custom menu (tanpa loop order_detail) -->
                                <div class="swiper-slide">
                                    <div
                                        class="flex flex-col items-center p-0.5 md:flex-row gap-x-6 md:gap-y-0 gap-y-3">
                                        <div class="wrap w-[30rem]">
                                            <img src="{{ asset('/asset/CustomOrder.png') }}"
                                                class="object-cover w-full rounded-lg h-44 md:w-full md:h-[13rem]"
                                                alt="" />
                                        </div>
                                        <div class="flex items-center justify-between w-full gap-2 md:gap-3 text-wrap">
                                            <div class="flex flex-col gap-3 wrap">
                                                <p class="text-xl font-semibold md:text-xl line-clamp-1">
                                                    Custom Pizza
                                                </p>
                                                <p class="text-xl uppercase md:text-lg text-highlight-content">
                                                    Size : {{ $item->size }}
                                                </p>
                                                <p class="text-xl md:text-lg"
                                                    id="subtotal-{{ $item->transaction_detail_ID }}">
                                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                </p>
                                            </div>
                                            <form action="{{ route('delete.cart', $item->transaction_ID) }}"
                                                method="POST" class="delete-form">
                                                @csrf
                                                @method('delete')
                                                <button type="button"
                                                    class="flex items-center justify-center p-1.5 rounded-full bg-secondary-color delete-cart-item"
                                                    data-id="{{ $item->transaction_detail_ID }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                        fill="none" viewBox="0 0 26 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="flex flex-col gap-3 mt-auto wrap">
                                <i
                                    class="p-6 mx-auto text-center text-white rounded-full text-7xl w-fit ti ti-shopping-cart-question bg-highlight-content"></i>
                                <p class="text-xl text-center">It seems you haven't made your choice yet!
                                </p>
                            </div>
                        @endforelse
                    </div>
                    <!-- End of cart item block -->
                </div>
            </div>
            <hr class="" />
            <div class="mt-auto">
                <p class="text-base text-center">
                    Shipping and taxes calculated at checkout.
                </p>
                <div class="flex items-center w-full gap-3 wrap">
                    <a class="w-full" href="{{ route('cart.view') }}">
                        <button class="w-full py-3 mt-4 font-semibold rounded-lg bg-secondary-color hover:bg-red-600">
                            VIEW CART
                        </button>
                    </a>
                    <a class="w-full" href="/payment">
                        <button class="w-full py-3 mt-4 font-semibold rounded-lg bg-secondary-color hover:bg-red-600">
                            PAYMENT
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/sidebar.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle item delete via AJAX
        $('.delete-cart-item').on('click', function(e) {
            e.preventDefault(); // Prevent default form submission
            var itemId = $(this).data('id'); // Get orderDetail_ID from data-id
            var form = $(this).closest('form'); // Get the closest form containing the delete button

            $.ajax({
                url: '/cart/delete/' + itemId, // URL for deleting the item
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(), // Include CSRF token
                    _method: 'DELETE' // Send DELETE method
                },
                success: function(response) {
                    if (response.success) {
                        // Show success notification
                        notyf.success(response.message);

                        // Remove the item from the cart view (DOM)
                        form.closest('.swiper-slide')
                            .remove(); // Adjust selector if necessary

                        // Optionally, update cart total or other elements here
                        $('#total-subtotal').text('Rp ' + response
                            .totalSubtotal); // Update total subtotal
                    } else {
                        // Show error message if item is not deleted
                        notyf.error(response.message);
                    }
                },
                error: function(xhr) {
                    // Handle AJAX error
                    notyf.error('Something went wrong. Please try again.');
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Fungsi untuk memperbarui kuantitas dan subtotal
        function updateQuantity(itemId, newQuantity) {
            $.ajax({
                url: '/cart/update/' + itemId, // URL untuk update kuantitas
                method: 'PUT',
                data: {
                    _token: $('input[name="_token"]').val(),
                    quantity: newQuantity
                },
                success: function(response) {
                    if (response.success) {
                        // Update tampilan kuantitas
                        $('#quantity-' + itemId).text(response.quantity);
                        $('#quantity-mobile' + itemId).text(response
                            .quantity); // Tambahan untuk kuantitas mobile

                        // Update subtotal
                        $('#subtotal-' + itemId).text('Rp ' + response.subtotal.toLocaleString(
                            'id-ID'));
                        // Update subtotal
                        $('#subtotal-mobile' + itemId).text('Rp ' + response.subtotal
                            .toLocaleString(
                                'id-ID'));
                        // Tampilkan notifikasi sukses
                        notyf.success(response.message);
                    } else {
                        // Tampilkan pesan error
                        notyf.error(response.message);

                        // Jika ada currentQuantity dalam response, kembalikan ke kuantitas semula
                        if (response.currentQuantity !== undefined) {
                            $('#quantity-' + itemId).text(response.currentQuantity);
                            $('#quantity-mobile' + itemId).text(response
                                .currentQuantity); // Tambahan untuk kuantitas mobile
                        }
                    }
                },
                error: function(xhr) {
                    // Parse error response
                    try {
                        var errorResponse = JSON.parse(xhr.responseText);
                        notyf.error(errorResponse.message || 'Something went wrong');
                    } catch (e) {
                        notyf.error('Something went wrong');
                    }
                }
            });
        }

        // Update kuantitas saat tombol decrease diklik
        $('.decrease-btn').on('click', function(e) {
            e.preventDefault();
            var itemId = $(this).data('id');
            var currentQuantity = parseInt($('#quantity-' + itemId).text());

            // Jika sudah di minimum (1), tampilkan pesan
            if (currentQuantity <= 1) {
                notyf.error('Minimum quantity is 1');
                return;
            }

            // Perbarui kuantitas dengan menurunkan
            updateQuantity(itemId, currentQuantity - 1);
        });

        // Update kuantitas saat tombol increase diklik
        $('.increase-btn').on('click', function(e) {
            e.preventDefault();
            var itemId = $(this).data('id');
            var currentQuantity = parseInt($('#quantity-' + itemId).text());

            // Jika sudah di maksimum (2), tampilkan pesan
            if (currentQuantity >= 2) {
                notyf.error('Maximum quantity is 2');
                return;
            }

            // Perbarui kuantitas dengan menambah
            updateQuantity(itemId, currentQuantity + 1);
        });
    });
</script>
