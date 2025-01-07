<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
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
        <section class="mt-10 md:mt-20 cart">
            <div class="container">
                <div class="flex flex-col grid-cols-12 gap-4 md:grid">
                    <div class="col-span-6 transition-all duration-300 ease-in-out box-cart font-aesthetnova">
                        <div
                            class="flex flex-col p-2.5 rounded-lg md:p-8 gap-y-8 content-body bg-secondary-accent-color">
                            <!-- Repeted Content -->
                            @foreach ($orderTransactions as $orderTransaction)
                                @foreach ($orderTransaction->details as $orderDetail)
                                    <div
                                        class="flex flex-col items-center w-full gap-12 justify-between md:p-0 p-0.5 md:flex-row md:gap-y-0 gap-y-3">
                                        <div class="relative wrap md:w-[50%] w-full">
                                            @if ($orderDetail->order_type == 'normal_menu')
                                                <img src="{{ isset($orderDetail->menu) && $orderDetail->menu->image ? asset('storage/' . $orderDetail->menu->image) : 'https://salonlfc.com/wp-content/uploads/2018/01/image-not-found-scaled.png' }}"
                                                    alt="{{ $orderDetail->menu_name ?? 'Unknown Menu' }}"
                                                    class="object-cover w-full rounded h-52 3xl:w-96 3xl:h-60 md:w-64 md:h-44" />
                                            @else
                                                <img src="{{ asset('/asset/CustomOrder.png') }}"
                                                    class="object-cover w-full rounded h-52 3xl:w-96 3xl:h-60 md:w-64 md:h-44"
                                                    alt="" />
                                            @endif
                                            <div
                                                class="absolute  z-10 -right-1 -top-3 px-5 py-2.5 rounded-full w-fit quantity-area bg-secondary-color">
                                                <p class="text-xl text-center md:text-base ms-auto">
                                                    {{ $orderDetail->quantity }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:w-[50%] w-full gap-2 text-wrap">
                                            @if ($orderDetail->order_type == 'normal_menu')
                                                <p class="text-xl font-medium md:text-lg line-clamp-1">
                                                    {{ $orderDetail->menu_name }}
                                                </p>
                                            @else
                                                <p class="text-xl font-medium md:text-lg line-clamp-1">
                                                    Custom Pizza
                                                </p>
                                            @endif
                                            <p
                                                class="text-xl font-medium uppercase md:text-lg line-clamp-1 text-highlight-content">
                                                ({{ $orderDetail->size }})
                                            </p>
                                            <div class="flex wrap">
                                                <p class="text-xl font-medium md:text-lg">Rp
                                                    {{ number_format($orderDetail->subtotal, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                            <!-- Repeated Content end -->
                            <hr class="border-[1px] border-gray-500" />
                            <div class="flex flex-col gap-3 wrap">
                                <!-- Total Payment -->
                                <span class="flex items-center justify-between">
                                    <p class="text-lg">Total Payment</p>
                                    <p class="text-lg">Rp
                                        {{ number_format($orderTransaction->total_amounts, 0, ',', '.') }}
                                    </p>
                                </span>
                            </div>
                            <!-- Cancel Order Form -->
                            <form id="cancel-form"
                                action="{{ route('order.cancel', $orderTransaction->transaction_ID) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button id="cancel-button" type="submit"
                                    class="self-end w-full gap-3 py-3 text-base transition-all duration-300 ease-in-out rounded-lg bg-secondary-color">
                                    Cancel Order
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-span-6 row-auto gap-4 text-base md:text-lg">
                        <div
                            class="sticky flex flex-col w-full gap-4 rounded-lg h-fit top-36 box-Location font-aesthetnova bg-secondary-accent-color">
                            <div class="px-4 py-4 rounded-t-lg bg-secondary-color header body md:px-8">
                                <p class="font-semibold uppercase">Payment Method</p>
                            </div>
                            <div class="px-4 py-4 body md:px-8">
                                <div class="user-quick-details flex items-center justify-between gap-0.5">
                                    <img src="../asset/Payment/Midtrans.png" class="md:w-[25%] w-[40%]"
                                        alt="" />
                                    <input type="checkbox"
                                        class="w-5 h-5 transition-all duration-300 ease-in-out bg-transparent border-2 rounded-full appearance-none cursor-pointer border-highlight-content checked:bg-highlight-content checked:border-highlight-content hover:border-none hover:bg-highlight-content" />
                                </div>
                            </div>
                            <div
                                class="flex flex-col items-center justify-between w-full gap-4 px-4 py-4 md:gap-0 md:px-8 footer">
                                <div class="flex items-center justify-between w-full wrap">
                                    <p class="text-sm text-highlight-content">
                                        Order That Been Pay Cannot Be Cancle *
                                    </p>
                                    <button id="initiate-payment" type="button"
                                        class="self-end gap-3 px-2 py-2 text-base text-center transition-all duration-300 ease-in-out rounded-lg w-fit 2xl:px-12 bg-secondary-color">
                                        Pay Now
                                    </button>
                                </div>
                                <form id="payment-form" class="w-full space-y-4"
                                    action="{{ route('order.pay', $orderTransaction->transaction_ID) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button id="complete-payment" type="submit"
                                        class="self-end w-full gap-3 px-2 py-2.5 text-base text-center transition-all duration-300 ease-in-out rounded-lg 2xl:px-12 bg-secondary-color opacity-50 cursor-not-allowed"
                                        disabled>
                                        Payment Finish
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const initiatePaymentBtn = document.getElementById('initiate-payment');
                const completePaymentBtn = document.getElementById('complete-payment');
                const cancelButton = document.getElementById('cancel-button');
                const paymentCheckbox = document.querySelector('.user-quick-details input[type="checkbox"]');

                // Disable the "Pay Now" button by default
                initiatePaymentBtn.disabled = true;
                initiatePaymentBtn.classList.add('opacity-50', 'cursor-not-allowed');

                // Add event listener to checkbox
                paymentCheckbox.addEventListener('change', function() {
                    if (paymentCheckbox.checked) {
                        initiatePaymentBtn.disabled = false;
                        initiatePaymentBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    } else {
                        initiatePaymentBtn.disabled = true;
                        initiatePaymentBtn.classList.add('opacity-50', 'cursor-not-allowed');
                    }
                });

                // Payment process logic
                const handlePaymentProcess = () => {
                    if (!paymentCheckbox.checked) {
                        alert('Please select the checkbox before proceeding with payment.');
                        return;
                    }

                    initiatePaymentBtn.disabled = true;
                    initiatePaymentBtn.textContent = 'Processing...';

                    fetch('/payment/get-transaction-token', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            credentials: 'same-origin'
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(Network error: $ {
                                    response.statusText
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.status === 'success' && data.token) {
                                snap.pay(data.token, {
                                    onSuccess: function(result) {
                                        console.log('Payment success:', result);
                                        alert('Payment successful!');

                                        // Enable Payment Finish button and update styles
                                        completePaymentBtn.disabled = false;
                                        completePaymentBtn.classList.remove('opacity-50',
                                            'cursor-not-allowed');

                                        // Disable Cancel button and add opacity
                                        cancelButton.disabled = true;
                                        cancelButton.style.opacity = '0.5';
                                        cancelButton.classList.add('cursor-not-allowed');

                                        // Hide Pay Now button
                                        initiatePaymentBtn.style.display = 'none';
                                    },
                                    onPending: function(result) {
                                        console.log('Payment pending:', result);
                                        alert('Payment pending. Please complete your payment');
                                        initiatePaymentBtn.disabled = false;
                                        initiatePaymentBtn.textContent = 'Pay Now';
                                    },
                                    onError: function(result) {
                                        console.error('Payment error:', result);
                                        alert('Payment failed!');
                                        initiatePaymentBtn.disabled = false;
                                        initiatePaymentBtn.textContent = 'Pay Now';
                                    },
                                    onClose: function() {
                                        console.log(
                                            'Customer closed the popup without finishing the payment'
                                        );
                                        alert('Payment cancelled');
                                        initiatePaymentBtn.disabled = false;
                                        initiatePaymentBtn.textContent = 'Pay Now';
                                    }
                                });
                            } else {
                                throw new Error(data.message || 'Failed to get transaction token');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error.message);
                            alert(Error: $ {
                                error.message
                            });
                            initiatePaymentBtn.disabled = false;
                            initiatePaymentBtn.textContent = 'Pay Now';
                        });
                };

                // Attach click event to "Pay Now" button
                if (initiatePaymentBtn) {
                    initiatePaymentBtn.addEventListener('click', handlePaymentProcess);
                }
            });
        </script>
    </main>
    @include('layout.Footer')
</body>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>
<!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
      AOS.init();
  </script> -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="{{ asset('/js/swiper.js') }}"></script>
<script src="{{ asset('/js/GSAP.js') }}"></script>
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<script src="{{ asset('/js/sidebar.js') }}"></script>
<script src="{{ asset('/js/boxLogin.js') }}"></script>

</html>
