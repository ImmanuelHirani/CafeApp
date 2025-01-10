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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
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
                    <h6 class="font-semibold uppercase text-highlight-content">Customize your own pizza </h6>
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
                    @isset($sizes)
                        @if ($sizes->isNotEmpty())
                            <div
                                class="text-xl transition-all border-b-[1px] duration-300 ease-in-out accordion-content max-h-0">
                                <div class="flex flex-wrap items-center px-0.5 gap-3 pb-6 mt-3 lg:mt-6 wrap">
                                    @foreach ($sizes as $size)
                                        <button data-id="{{ $size->size_ID }}" data-price="{{ $size->price }}"
                                            data-max-toppings="{{ $size->allowed_flavor }}"
                                            class="w-[20%] p-3 hover:bg-secondary-color transition-all ease-in-out duration-300 size-button rounded-full outline outline-2 outline-white ">
                                            {{ $size->size }}
                                        </button>
                                    @endforeach
                                </div>
                                <p class="text-highlight-content">Note :</p>
                                <ul class="pb-6 space-y-1 list-disc list-inside text-accent-color">
                                    @foreach ($sizes as $index => $size)
                                        <li><span class="uppercase">{{ $size->size }}</span> ({{ $size->allowed_flavor }}
                                            Flavor)</li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <p class="text-lg text-highlight-content">No sizes available at the moment.
                            </p>
                        @endif
                    @else
                        <p class="text-lg text-highlight-content">Sizes information is unavailable.</p>
                    @endisset
                </div>
                @foreach ($categories as $category)
                    <div class="flex flex-col px-1 overflow-hidden accordion-wrapper">
                        <div class="accordion-head">
                            <div
                                class="flex items-center justify-between pb-3 cursor-pointer lg:pb-6 head-wrapper-accordion">
                                <p class="text-xl lg:text-4xl">{{ $category->categories_type }}</p>
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
                                @if ($category->properties->where('is_active', 1)->isNotEmpty())
                                    @foreach ($category->properties as $property)
                                        @if ($property->is_active == 1)
                                            <button data-price="{{ $property->price }}"
                                                data-name="{{ $property->properties_name }}"
                                                class="px-8 py-3 text-sm transition-all duration-300 ease-in-out rounded-full hover:bg-secondary-color topping-button w-fit outline outline-2 outline-white 3xl:text-xl lg:text-xl">
                                                {{ $property->properties_name }}
                                            </button>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="text-red-500">Topping untuk kategori ini belum ada.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <img src="../asset/CustomOrder.png"
                class="relative top-0 w-full col-span-5 row-span-5 wrap lg:sticky lg:top-36" alt="" />
            <div
                class="container fixed z-50 w-full text-white translate-x-1/2 right-1/2 bottom-4 add-to-cart-custom-order">
                <form action="{{ route('store.custom.order') }}" method="POST"
                    class="flex flex-col items-center justify-between w-full p-4 rounded-lg md:p-6 lg:gap-y-0 gap-y-4 lg:flex-row wrap outline outline-1 outline-highlight-content bg-secondary-accent-color">
                    @csrf
                    <!-- Informasi Pesanan -->
                    <div class="lg:w-[60%] w-full space-y-1 wrap">
                        <p id="selected-size" class="text-xl lg:text-2xl">Custom Pizza</p>
                        <input type="hidden" name="size_name" id="size-input" value="">
                        <p id="selected-toppings" class="text-sm lg:text-xl text-highlight-content"></p>
                        <input type="hidden" name="toppings" id="toppings-input" value="">
                        <p id="total-price" class="text-xl lg:text-2xl">Total : </p>
                        <input type="hidden" name="total_price" id="total-price-input" value="">
                    </div>
                    <!-- Kontrol Jumlah dan Tombol Add to Cart -->
                    <div
                        class="flex flex-col items-center justify-between lg:w-[20%] w-full gap-3 rounded-lg add-to-cart">
                        <div class="flex items-center justify-center w-full gap-3 wrap">
                            <p class="text-sm font-medium md:text-base text-highlight-content">!Only One Each
                                Transaction.</p>
                        </div>
                        <!-- Tombol Add to Cart -->
                        <button type="submit"
                            class="w-full gap-3 px-2 py-3 text-sm font-semibold rounded-lg 2xl:px-5 2xl:text-lg bg-secondary-color">
                            ADD TO CART
                        </button>
                    </div>
                </form>
            </div>
        </section>
        @include('layout.popovers.aside.sidebar-frontend')
        @include('layout.modal.login-registerBox.Auth-Customer')
    </main>
    @include('layout.Footer')
</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="{{ asset('/js/swiper.js') }}"></script>
<script src="{{ asset('/js/GSAP.js') }}"></script>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let selectedSize = null; // Ukuran yang dipilih
        let selectedToppings = []; // Daftar topping yang dipilih
        let totalPrice = 0; // Total harga

        const sizeOutput = document.querySelector('.add-to-cart-custom-order #selected-size');
        const toppingsOutput = document.querySelector('.add-to-cart-custom-order #selected-toppings');
        const totalPriceOutput = document.querySelector('#total-price');
        const hiddenToppingsInput = document.getElementById('toppings-input');
        const hiddenTotalPriceInput = document.getElementById('total-price-input');
        const hiddenSizeInput = document.getElementById('size-input');

        const sizeButtons = document.querySelectorAll('.size-button');
        const toppingButtons = document.querySelectorAll('.topping-button');

        // Fungsi untuk menghitung total harga
        function calculateTotal() {
            if (!selectedSize) {
                notyf.error("Please select a size first.");
                return;
            }

            let toppingPrice = 0;
            selectedToppings.forEach(toppingName => {
                const topping = document.querySelector(`.topping-button[data-name="${toppingName}"]`);
                if (topping) {
                    toppingPrice += parseFloat(topping.getAttribute('data-price'));
                }
            });

            totalPrice = selectedSize.price + toppingPrice;

            // Jika selectedToppings kosong, kirimkan array kosong
            const toppingsData = selectedToppings.length > 0 ? selectedToppings : [];

            fetch('/calculate-total', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        size_id: selectedSize.id,
                        size_name: selectedSize.name,
                        toppings: toppingsData,
                        total_price: totalPrice,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        notyf.error(data.error);
                        return;
                    }

                    // Update total harga
                    totalPriceOutput.innerHTML = `Rp.${totalPrice.toLocaleString('id-ID')}`;
                    updateHiddenInputs(); // Panggil untuk memperbarui input tersembunyi
                })
                .catch(error => {
                    console.error('Error:', error);
                    notyf.error("Login First! To Make an order");
                });
        }

        // Fungsi untuk memperbarui input tersembunyi
        function updateHiddenInputs() {
            hiddenToppingsInput.value = selectedToppings.join(', ');
            hiddenTotalPriceInput.value = totalPrice;
            hiddenSizeInput.value = selectedSize.name;
        }

        // Event Listener untuk tombol Size
        sizeButtons.forEach(button => {
            button.addEventListener('click', function() {
                sizeButtons.forEach(btn => btn.classList.remove('bg-red-500', 'text-white',
                    '!outline-none'));
                this.classList.add('bg-red-500', 'text-white', '!outline-none');

                const sizePrice = parseFloat(this.getAttribute('data-price'));
                const maxToppings = parseInt(this.getAttribute('data-max-toppings'));
                const sizeId = this.getAttribute('data-id');

                selectedSize = {
                    id: sizeId,
                    name: this.innerText.trim(),
                    price: sizePrice,
                    maxToppings: maxToppings,
                };

                sizeOutput.innerHTML = `Custom Pizza - (${selectedSize.name})`;

                selectedToppings = [];
                toppingButtons.forEach(btn => btn.classList.remove('bg-red-500', 'text-white',
                    '!outline-none'));

                toppingsOutput.innerHTML = 'No Toppings Selected';
                totalPrice = selectedSize.price;
                totalPriceOutput.innerHTML = `Rp.${totalPrice.toLocaleString('id-ID')}`;
                updateHiddenInputs();
            });
        });

        // Event Listener untuk tombol Topping
        toppingButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (!selectedSize) {
                    notyf.error("Please select a size first.");
                    return;
                }

                const toppingPrice = parseFloat(this.getAttribute('data-price'));
                const toppingName = this.getAttribute('data-name');

                if (selectedToppings.includes(toppingName)) {
                    selectedToppings = selectedToppings.filter(item => item !== toppingName);
                    this.classList.remove('bg-red-500', 'text-white', '!outline-none');
                } else {
                    if (selectedToppings.length >= selectedSize.maxToppings) {
                        notyf.open({
                            type: 'warning',
                            message: `Max only ${selectedSize.maxToppings} toppings for this size.`,
                        });
                        return;
                    }
                    selectedToppings.push(toppingName);
                    this.classList.add('bg-red-500', 'text-white', '!outline-none');
                }

                toppingsOutput.innerHTML = selectedToppings.length > 0 ? selectedToppings.join(
                    ', ') : 'No Toppings Selected';
                calculateTotal();
            });
        });

        // Event Listener untuk form submit
        const form = document.querySelector('.add-to-cart-custom-order form');
        form.addEventListener('submit', function(e) {
            // Validasi sebelum submit
            if (!selectedSize) {
                e.preventDefault();
                notyf.error("Please select a size first.");
                return;
            }

            if (selectedToppings.length === 0) {
                notyf.error("Please select at least one topping.");
                e.preventDefault();
                return;
            }

            // Lanjutkan submit jika semua valid
            updateHiddenInputs(); // Pastikan data sudah ada di input tersembunyi
        });

        // Set default value kosong saat halaman dimuat
        sizeOutput.innerHTML = 'Custom Pizza - (No Size Selected)';
        toppingsOutput.innerHTML = 'No Toppings Selected';
        totalPriceOutput.innerHTML = 'Rp.0';
        updateHiddenInputs();
    });
</script>

</html>
