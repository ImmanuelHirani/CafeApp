<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
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
        <section class="mt-14 md:mt-20 cart">
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
                                        <div class="relative wrap w-[50%]">
                                            @if ($orderDetail->order_type == 'normal_menu')
                                                <img src="{{ asset('storage/' . $orderDetail->menu->image) }}"
                                                    alt="{{ $orderDetail->menu_name }}"
                                                    class="object-cover w-full rounded h-52 3xl:w-96 3xl:h-60 md:w-64 md:h-44" />
                                            @else
                                                <img src="{{ asset('/asset/CustomOrder.png') }}"
                                                    class="object-cover w-full rounded h-52 3xl:w-96 3xl:h-60 md:w-64 md:h-44"
                                                    alt="" />
                                            @endif
                                            <div
                                                class="absolute w-full z-10 -right-1 -top-3 px-5 py-2.5 rounded-full md:w-fit quantity-area bg-secondary-color">
                                                <p class="text-xl text-center md:text-base ms-auto">
                                                    {{ $orderDetail->quantity }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col w-[50%] gap-2 text-wrap">
                                            @if ($orderDetail->order_type == 'normal_menu')
                                                <p class="text-xl font-semibold md:text-lg line-clamp-1">
                                                    {{ $orderDetail->menu_name }}
                                                </p>
                                            @else
                                                <p class="text-xl font-semibold md:text-lg line-clamp-1">
                                                    Custom Pizza
                                                </p>
                                            @endif
                                            <p
                                                class="text-xl font-semibold uppercase md:text-lg line-clamp-1 text-highlight-content">
                                                ({{ $orderDetail->size }})
                                            </p>
                                            <div class="flex wrap">
                                                <p class="text-xl font-semibold md:text-lg">Rp
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
                                <!-- Subtotal -->
                                <span class="flex items-center justify-between">
                                    <p class="text-lg">Subtotal</p>
                                    <p class="text-lg">Rp
                                        {{ number_format($orderTransaction->total_amounts, 0, ',', '.') }}
                                    </p>
                                </span>
                                <!-- Shipping -->
                                <span class="flex items-center justify-between">
                                    <p class="flex items-center gap-3 text-lg text-highlight-content">
                                        Shipping
                                        <img src="../asset/QuestionMark-Shipping.png" class="w-[10%]" alt="" />
                                    </p>
                                    <p class="text-lg text-highlight-content">Rp. 20.000</p>
                                </span>
                                <!-- Total Payment -->
                                <span class="flex items-center justify-between">
                                    <p class="text-lg">Total Payment</p>
                                    <p class="text-lg">Rp
                                        {{ number_format($orderTransaction->total_amounts + 20000, 0, ',', '.') }}
                                    </p>
                                </span>
                            </div>
                            <!-- Cancel Order Form -->
                            <form action="{{ route('order.cancel', $orderTransaction->order_ID) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit"
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
                                class="flex flex-col items-center justify-between gap-4 px-4 py-4 md:gap-0 md:flex-row md:px-8 footer">
                                <p class="text-sm text-highlight-content">
                                    Order That Been Pay Cannot Be Cancle *
                                </p>
                                <form action="{{ route('order.pay', $orderTransaction->order_ID) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="self-end w-full gap-3 px-2 py-2.5 text-base text-center transition-all duration-300 ease-in-out rounded-lg md:w-fit 2xl:px-12 bg-secondary-color">
                                        Pay Now
                                    </button>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Login & register Box -->
        @include('layout.AuthCustomer')
    </main>
    @include('layout.Footer')
</body>
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
