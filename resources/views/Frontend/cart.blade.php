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
        <section class="mt-14 md:mt-20 cart">
            <div class="container">
                <div class="flex flex-col grid-cols-12 gap-4 md:grid">
                    <div class="flex flex-col col-span-8 gap-4 text-base md:text-lg row-span-8">
                        <div
                            class="flex flex-col self-start w-full gap-4 px-4 py-4 rounded-lg h-fit md:px-8 box-Location font-aesthetnova bg-secondary-accent-color">
                            <span class="flex items-center justify-between">
                                <p class="uppercase">Shipping Details</p>
                                <a href="" class="flex items-center gap-3 text-green-500">Change Detail
                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-green-500" width="18"
                                        height="18" viewBox="0 0 18 24" fill="none">
                                        <path
                                            d="M0 15C0 15.7956 0.316071 16.5587 0.87868 17.1213C1.44129 17.6839 2.20435 18 3 18H8V23C8 23.2652 8.10536 23.5196 8.29289 23.7071C8.48043 23.8946 8.73478 24 9 24C9.26522 24 9.51957 23.8946 9.70711 23.7071C9.89464 23.5196 10 23.2652 10 23V18H15C15.724 18.002 16.4241 17.7414 16.9706 17.2666C17.5171 16.7917 17.8729 16.1349 17.972 15.4177C18.0712 14.7006 17.9069 13.9718 17.5097 13.3665C17.1125 12.7612 16.5094 12.3205 15.812 12.126L14.212 5.737C14.8371 5.45648 15.3474 4.97042 15.6579 4.35966C15.9685 3.7489 16.0606 3.05024 15.919 2.37986C15.7773 1.70948 15.4105 1.10778 14.8795 0.674814C14.3484 0.241849 13.6852 0.00371064 13 0L5 0C4.31458 0.00303401 3.65086 0.240689 3.1193 0.673418C2.58774 1.10615 2.22039 1.70785 2.07838 2.37841C1.93636 3.04896 2.02825 3.74793 2.33876 4.35899C2.64926 4.97006 3.15965 5.45637 3.785 5.737L2.185 12.126C1.55818 12.3029 1.00597 12.6791 0.611789 13.1975C0.217605 13.716 0.00286194 14.3487 0 15ZM15 16H3C2.73478 16 2.48043 15.8946 2.29289 15.7071C2.10536 15.5196 2 15.2652 2 15C2 14.7348 2.10536 14.4804 2.29289 14.2929C2.48043 14.1054 2.73478 14 3 14H15C15.2652 14 15.5196 14.1054 15.7071 14.2929C15.8946 14.4804 16 14.7348 16 15C16 15.2652 15.8946 15.5196 15.7071 15.7071C15.5196 15.8946 15.2652 16 15 16ZM4.281 12L5.781 6H12.219L13.719 12H4.281ZM5 2H13C13.2652 2 13.5196 2.10536 13.7071 2.29289C13.8946 2.48043 14 2.73478 14 3C14 3.26522 13.8946 3.51957 13.7071 3.70711C13.5196 3.89464 13.2652 4 13 4H5C4.73478 4 4.48043 3.89464 4.29289 3.70711C4.10536 3.51957 4 3.26522 4 3C4 2.73478 4.10536 2.48043 4.29289 2.29289C4.48043 2.10536 4.73478 2 5 2Z" />
                                    </svg>
                                </a>
                            </span>
                            <hr />
                            <div class="user-quick-details flex flex-col gap-0.5">
                                <p class="text-highlight-content">Name & Phone Number</p>
                                <p>Immanuel Christian Hirani</p>
                                <p>(081314801945)</p>
                            </div>
                            <div class="user-quick-details flex flex-col gap-0.5">
                                <p class="text-highlight-content">Location</p>
                                <p>
                                    Kampus Kijang Jl. Kemanggisan Ilir III No. 45, Kemanggisan /
                                    Palmerah Jakarta Barat 11480, Indonesia
                                </p>
                            </div>
                            <hr />
                            <button
                                class="self-end w-full gap-3 px-2 py-2 text-base transition-all duration-300 ease-in-out rounded-lg md:w-fit 2xl:px-5 outline outline-1 outline-secondary-color hover:bg-secondary-color">
                                Choose Other Location?
                            </button>
                        </div>
                        @forelse ($temp_cart as $cart)
                            <div
                                class="relative flex items-center self-start w-full gap-5 px-3 py-3 rounded-lg outline outline-1 outline-highlight-content md:justify-between h-fit md:px-4 md:py-4 cart-item font-aesthetnova bg-secondary-accent-color">
                                <img src="{{ asset('storage/' . $cart->menu->image) }}"
                                    class="md:w-[220px] w-[140px] object-cover rounded-lg h-fit md:h-[180px]"
                                    alt="" />
                                <div class="flex flex-col gap-3 wrap">
                                    <p>{{ $cart->menu->name }}</p>
                                    <p class="text-highlight-content">Extra : -</p>
                                    <div class="flex items-center gap-3 md:hidden wrap">
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
                                            <span class="text-base md:text-lg text-accent-color">{{ $cart->quantity }}
                                            </span>
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
                                    </div>
                                    <p class="inline-block md:hidden">Rp 500.000</p>
                                </div>
                                <div class="items-center hidden gap-3 md:flex wrap">
                                    <form action="{{ route('cart.update', $cart->temp_ID) }}" method="POST"
                                        class="cart-form">
                                        @csrf
                                        @method('PUT')
                                        <div
                                            class="flex items-center justify-center gap-8 px-4 py-1.5 rounded-full w-fit outline outline-1 outline-white">
                                            <button type="button" class="decrease-btn" data-id="{{ $cart->temp_ID }}">
                                                <i class="ti ti-minus"></i>
                                            </button>
                                            <span id="quantity-{{ $cart->temp_ID }}"
                                                class="text-base md:text-lg text-accent-color">
                                                {{ $cart->quantity }}
                                            </span>
                                            <button type="button" class="increase-btn" data-id="{{ $cart->temp_ID }}">
                                                <i class="ti ti-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <form action="{{ route('delete.cart', $cart->temp_ID) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('delete')
                                        <button type="button"
                                            class="flex items-center justify-center p-1.5 rounded-full bg-secondary-color delete-cart-item"
                                            data-id="{{ $cart->temp_ID }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 26 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <div class="flex items-center justify-between wrap">
                                    <p class="text-xl md:text-lg" id="subtotal-{{ $cart->temp_ID }}">
                                        Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                                    </p>
                                </div>
                                <button
                                    class="md:hidden flex items-center absolute -top-1 -right-1 justify-center p-1.5 rounded-full bg-secondary-color">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 26 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 16 16" fill="none">
                                <path
                                    d="M7.26606 11.3931L2.77871 6.26394C2.24914 5.66045 2.67954 4.71265 3.48325 4.71265H12.4579C12.6378 4.71249 12.8139 4.76419 12.9652 4.86155C13.1164 4.9589 13.2364 5.09779 13.3107 5.26158C13.3851 5.42537 13.4106 5.60712 13.3843 5.78506C13.3581 5.963 13.281 6.12959 13.1625 6.26488L8.67514 11.3922C8.58732 11.4927 8.47901 11.5732 8.3575 11.6284C8.23598 11.6836 8.10406 11.7122 7.9706 11.7122C7.83714 11.7122 7.70522 11.6836 7.5837 11.6284C7.46219 11.5732 7.35388 11.4927 7.26606 11.3922V11.3931Z"
                                    fill="white" />
                            </svg>
                        </div>
                        <div class="flex flex-col gap-3 px-3 py-3 rounded-b-lg content-body bg-secondary-accent-color">
                            <!-- Repeted Content -->
                            <span class="flex items-center justify-between">
                                <p class="flex items-center gap-3 text-lg text-highlight-content">
                                    Shipping
                                    <img src="../asset/QuestionMark-Shipping.png" class="w-[10%]" alt="" />
                                </p>
                            </span>
                            @if (isset($cart))
                                <span class="flex items-center justify-between">
                                    <p class="text-xl">Total</p>
                                    <p class="text-xl" id="totalsubtotal-{{ $cart->temp_ID }}">
                                        Rp <span
                                            id="totalAmount">{{ number_format($totalSubtotal, 0, ',', '.') }}</span>
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
        @include('layout.AuthCustomer')
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
        // Initialize the total subtotal from the backend
        let totalSubtotal = parseFloat($('#totalAmount').text().replace('Rp ', '').replace('.', '').trim());

        // Handle item delete via AJAX
        $('.delete-cart-item').on('click', function(e) {
            e.preventDefault(); // Prevent form submission
            var itemId = $(this).data('id'); // Get temp_ID from data-id
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

                        // Update subtotal display
                        $('#subtotal-' + itemId).text('Rp ' + response.subtotal.toLocaleString(
                            'id-ID'));


                        // Update the total subtotal after quantity change
                        updateTotalSubtotal(response.subtotal - response.oldSubtotal);

                        // Show success notification
                        notyf.success(response.message);
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
            $('#totalAmount').text('Rp ' + totalSubtotal.toLocaleString('id-ID')); // Update the display
        }
    });
</script>

</html>
