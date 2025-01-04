<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    @vite('resources/css/app.css')
</head>

<body>
    @include('layout.Navbar')
    <main>
        <section class="mt-10 md:mt-20 cart">
            <div class="container">
                <div class="flex flex-col grid-cols-12 gap-4 md:grid">
                    <div class="flex flex-col col-span-8 gap-4 text-base md:text-lg row-span-8">
                        <div
                            class="flex flex-col self-start w-full gap-4 px-4 py-4 rounded-lg h-fit md:px-8 box-Location font-aesthetnova bg-secondary-accent-color">
                            <span class="flex items-center justify-between">
                                <p class="uppercase">Shipping Details</p>
                            </span>
                            <hr />
                            <div class="user-quick-details flex flex-col gap-0.5">
                                <p class="text-highlight-content">Name & Phone Number</p>
                                <p>{{ $primaryLocation->reciver_name }}</p>
                                <p>({{ $primaryLocation->reciver_number }})</p>
                            </div>
                            <div class="user-quick-details flex flex-col gap-0.5">
                                <p class="text-highlight-content">Location</p>
                                <p>( {{ $primaryLocation->location_label }} )</p>
                                <p>
                                    {{ $primaryLocation->reciver_address }}
                                </p>
                            </div>
                            <hr />
                            <a href="/profile#locations"
                                class="self-end w-full gap-3 px-2 py-2 text-base text-center transition-all duration-300 ease-in-out rounded-lg md:w-fit 2xl:px-5 outline outline-1 outline-secondary-color hover:bg-secondary-color">
                                Change Primary Location ?
                            </a>
                        </div>
                        @forelse ($cart_items as $cart)
                            @if ($cart->order->status_order == 'pending')
                                @if ($cart->order_type == 'normal_menu')
                                    <div
                                        class="relative flex items-center self-start w-full gap-4 px-3 py-3 rounded-lg md:gap-12 outline outline-1 outline-highlight-content md:justify-between h-fit md:px-4 md:py-4 cart-item font-aesthetnova bg-secondary-accent-color">
                                        <div
                                            class="wrap md:w-[30%] w-[12rem] h-[10rem] md:h-[180px] overflow-hidden rounded-lg ">
                                            <img src="{{ asset('storage/' . $cart->menu->image) }}"
                                                class="object-cover w-full h-full " alt="" />
                                        </div>
                                        <div class="flex md:w-[30%] w-[70%]  flex-col gap-3 wrap">
                                            <p class="line-clamp-1">{{ $cart->menu->name }}</p>
                                            <p class="uppercase text-highlight-content">Size : {{ $cart->size }}</p>
                                            <div class="flex items-center gap-3 md:hidden wrap">
                                                <form action="{{ route('cart.update', $cart->transaction_ID) }}"
                                                    method="POST" class="cart-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <div
                                                        class="flex items-center justify-center gap-8 px-4 py-1.5 rounded-full w-fit outline outline-1 outline-white">
                                                        <button type="button" class="decrease-btn"
                                                            data-id="{{ $cart->transaction_detail_ID }}">
                                                            <i class="ti ti-minus"></i>
                                                        </button>
                                                        <span id="quantity-mobile{{ $cart->transaction_detail_ID }}"
                                                            class="text-base md:text-lg text-accent-color">
                                                            {{ $cart->quantity }}
                                                        </span>
                                                        <button type="button" class="increase-btn"
                                                            data-id="{{ $cart->transaction_detail_ID }}">
                                                            <i class="ti ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                                <form action="{{ route('delete.cart', $cart->transaction_ID) }}"
                                                    method="POST" class="delete-form">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button"
                                                        class="flex items-center justify-center p-1.5 rounded-full bg-secondary-color delete-cart-item"
                                                        data-id="{{ $cart->transaction_detail_ID }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                            fill="none" viewBox="0 0 26 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                            <p class="inline-block text-base md:hidden"
                                                id="subtotal-mobile{{ $cart->transaction_detail_ID }}">
                                                Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="items-center hidden w-[20%]   gap-3 md:flex wrap">
                                            <form action="{{ route('cart.update', $cart->transaction_ID) }}"
                                                method="POST" class="cart-form">
                                                @csrf
                                                @method('PUT')
                                                <div
                                                    class="flex items-center justify-center gap-8 px-4 py-1.5 rounded-full w-fit outline outline-1 outline-white">
                                                    <button type="button" class="decrease-btn"
                                                        data-id="{{ $cart->transaction_detail_ID }}">
                                                        <i class="ti ti-minus"></i>
                                                    </button>
                                                    <span id="quantity-{{ $cart->transaction_detail_ID }}"
                                                        class="text-base md:text-lg text-accent-color">
                                                        {{ $cart->quantity }}
                                                    </span>
                                                    <button type="button" class="increase-btn"
                                                        data-id="{{ $cart->transaction_detail_ID }}">
                                                        <i class="ti ti-plus"></i>
                                                    </button>
                                                </div>
                                            </form>
                                            <form action="{{ route('delete.cart', $cart->transaction_ID) }}"
                                                method="POST" class="delete-form">
                                                @csrf
                                                @method('delete')
                                                <button type="button"
                                                    class="flex items-center justify-center p-1.5 rounded-full bg-secondary-color delete-cart-item"
                                                    data-id="{{ $cart->transaction_detail_ID }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                        fill="none" viewBox="0 0 26 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="md:flex hidden items-center justify-center w-[20%]  wrap">
                                            <p class="text-xl md:text-lg"
                                                id="subtotal-{{ $cart->transaction_detail_ID }}">
                                                Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                @if ($cart->order_type == 'custom_menu')
                                    <div
                                        class="relative flex items-center self-start w-full gap-4 px-3 py-3 rounded-lg md:gap-12 outline outline-1 outline-highlight-content md:justify-between h-fit md:px-4 md:py-4 cart-item font-aesthetnova bg-secondary-accent-color">
                                        <div
                                            class="wrap md:w-[30%] w-[12rem] h-[10rem] md:h-[180px] overflow-hidden rounded-lg ">
                                            <img src="{{ asset('/asset/CustomOrder.png') }}"
                                                class="object-cover w-full h-full overflow-hidden " alt="" />
                                        </div>
                                        <div class="flex md:w-[30%] w-[70%]  flex-col gap-3 wrap">
                                            <p>Custom Pizza</p>
                                            <p class="uppercase text-highlight-content">Size : {{ $cart->size }}</p>
                                            <div class="flex items-center w-full gap-3 md:hidden wrap">
                                                <div class="wrap">
                                                    <p>Max Qty :1</p>
                                                </div>
                                                <form action="{{ route('delete.cart', $cart->transaction_ID) }}"
                                                    method="POST" class="delete-form">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button"
                                                        class="flex items-center justify-center p-1.5 rounded-full bg-secondary-color delete-cart-item"
                                                        data-id="{{ $cart->transaction_detail_ID }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                            fill="none" viewBox="0 0 26 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                            <p class="inline-block text-base md:hidden"
                                                id="subtotal-mobile{{ $cart->transaction_detail_ID }}">
                                                Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="items-center w-[20%]  hidden gap-3 md:flex wrap">
                                            <div class="wrap">
                                                <p>Max Qty :1</p>
                                            </div>
                                            <form action="{{ route('delete.cart', $cart->transaction_ID) }}"
                                                method="POST" class="delete-form">
                                                @csrf
                                                @method('delete')
                                                <button type="button"
                                                    class="flex items-center justify-center p-1.5 rounded-full bg-secondary-color delete-cart-item"
                                                    data-id="{{ $cart->transaction_detail_ID }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                        fill="none" viewBox="0 0 26 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="md:flex  hidden items-center justify-center w-[20%]  wrap">
                                            <p class="text-xl md:text-lg"
                                                id="subtotal-{{ $cart->transaction_detail_ID }}">
                                                Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @empty
                            <div
                                class="relative flex items-center self-start w-full gap-5 px-3 py-3 rounded-lg outline outline-1 outline-highlight-content md:justify-between h-fit md:px-4 md:py-4 box-Location font-aesthetnova bg-secondary-accent-color">
                            </div>
                        @endforelse
                    </div>
                    <div
                        class="sticky col-span-4 transition-all duration-300 ease-in-out top-36 box-cart font-aesthetnova">
                        <div
                            class="flex items-center justify-between px-3 py-3 rounded-t-lg header bg-secondary-color">
                            <p class="text-xl md:text-xl">Order Summary</p>
                        </div>
                        <div class="flex flex-col gap-3 px-3 py-3 rounded-b-lg content-body bg-secondary-accent-color">
                            <!-- Repeted Content -->
                            {{-- <span class="flex items-center justify-between">
                                <p class="flex items-center gap-3 text-lg text-highlight-content">
                                    Shipping
                                    <img src="../asset/QuestionMark-Shipping.png" class="w-[10%]" alt="" />
                                </p>
                            </span> --}}
                            @if (isset($cart))
                                <span class="flex items-center justify-between py-4">
                                    <p class="text-lg md:text-xl">Total</p>
                                    <p class="text-lg md:text-xl"
                                        id="totalsubtotal-{{ $cart->transaction_detail_ID }}">
                                        <span id="totalAmount">Rp
                                            {{ number_format($totalSubtotal, 0, ',', '.') }}</span>
                                    </p>
                                </span>
                            @else
                                <span class="flex items-center justify-between">
                                    <p class="text-xl">Total</p>
                                    <p class="text-xl" id="totalsubtotal-empty">
                                        Rp <span id="totalAmount">0</span>
                                    </p>
                                </span>
                            @endif
                            <span class="makeOrder">
                                <div class="flex items-center justify-between gap-1 rounded-lg MakeOrder">
                                    <a href="{{ route('make.order') }}"
                                        class="w-full gap-3 px-2 py-3 text-base text-center rounded-lg 2xl:px-5 bg-secondary-color">
                                        Make Order
                                    </a>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    @include('layout.Footer')
</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<script src="{{ asset('/js/swiper.js') }}"></script>
<script src="{{ asset('/js/GSAP.js') }}"></script>
<script src="{{ asset('/js/sidebar.js') }}"></script>
<script src="{{ asset('/js/boxLogin.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize the total subtotal from the backend - improved parser
        let totalSubtotal = parseFloat($('#totalAmount').text().replace(/[^\d]/g, ''));

        // Handle item delete via AJAX
        $('.delete-cart-item').on('click', function(e) {
            e.preventDefault(); // Prevent form submission
            var itemId = $(this).data('id'); // Get transaction_ID from data-id
            var form = $(this).closest('form'); // Get the form containing the delete button

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

                        // Remove the item from the view
                        form.closest('.cart-item').remove();

                        // Update the total subtotal after item is deleted
                        updateTotalSubtotal(-response
                            .deletedSubtotal); // Subtract the deleted item's subtotal

                        // Update the total displayed subtotal from the response
                        $('#totalAmount').text('Rp ' + formatNumber(response
                            .totalSubtotal));
                    } else {
                        notyf.error(response
                            .message); // Show error message if deletion fails
                    }
                },
                error: function(xhr) {
                    notyf.error('Something went wrong. Please try again.');
                }
            });
        });

        // Update quantity when decrease button is clicked
        $('.decrease-btn').on('click', function(e) {
            e.preventDefault();
            var itemId = $(this).data('id');
            var currentQuantity = parseInt($('#quantity-' + itemId).text());

            // If the quantity is at minimum (1), show a message
            if (currentQuantity <= 1) {
                notyf.error('Minimum quantity is 1');
                return;
            }

            updateQuantity(itemId, currentQuantity - 1);
        });

        // Update quantity when increase button is clicked
        $('.increase-btn').on('click', function(e) {
            e.preventDefault();
            var itemId = $(this).data('id');
            var currentQuantity = parseInt($('#quantity-' + itemId).text());

            // If the quantity is at maximum (2), show a message
            if (currentQuantity >= 2) {
                notyf.error('Maximum quantity is 2');
                return;
            }

            updateQuantity(itemId, currentQuantity + 1);
        });

        // Function to update quantity and subtotal
        function updateQuantity(itemId, newQuantity) {
            $.ajax({
                url: '/cart/update/' + itemId,
                method: 'PUT',
                data: {
                    _token: $('input[name="_token"]').val(),
                    quantity: newQuantity
                },
                success: function(response) {
                    if (response.success) {
                        // Update quantity display
                        $('#quantity-' + itemId).text(response.quantity);
                        $('#quantity-mobile' + itemId).text(response.quantity);

                        // Update subtotal display
                        $('#subtotal-mobile' + itemId).text('Rp ' + formatNumber(response
                            .subtotal));
                        $('#subtotal-' + itemId).text('Rp ' + formatNumber(response.subtotal));

                        // Update the total subtotal after quantity change
                        updateTotalSubtotal(response.subtotal - response.oldSubtotal);

                        // Show success notification
                        notyf.success(response.message);

                        // Update the total displayed subtotal from the response
                        $('#totalAmount').text('Rp ' + formatNumber(response.totalSubtotal));
                    } else {
                        notyf.error(response.message); // Show error message
                    }
                },
                error: function(xhr) {
                    try {
                        var errorResponse = JSON.parse(xhr.responseText);
                        notyf.error(errorResponse.message || 'Something went wrong');
                    } catch (e) {
                        notyf.error('Something went wrong');
                    }
                }
            });
        }

        // Function to update the total subtotal
        function updateTotalSubtotal(amount) {
            totalSubtotal += amount; // Add or subtract based on the action
            $('#totalAmount').text('Rp ' + formatNumber(totalSubtotal)); // Update the display
        }

        // Helper function to format numbers to Indonesian Rupiah format
        function formatNumber(number) {
            return Math.round(number).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    });
</script>


</html>
