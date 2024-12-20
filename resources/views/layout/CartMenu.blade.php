<div class="hidden col-span-3 row-span-2 transition-all duration-300 ease-in-out md:block">
    <div class="sticky transition-all duration-300 ease-in-out top-36 box-cart font-aesthetnova">
        <div class="flex items-center justify-between px-3 py-3 rounded-t-lg header bg-secondary-color">
            <p class="text-lg 3xl:text-xl">Atur Jumlah & Detail Pesanan</p>
            <svg xmlns="http://www.w3.org/2000/svg" width="24 " height="24 " viewBox="0 0 16 16" fill="none">
                <path
                    d="M7.26606 11.3931L2.77871 6.26394C2.24914 5.66045 2.67954 4.71265 3.48325 4.71265H12.4579C12.6378 4.71249 12.8139 4.76419 12.9652 4.86155C13.1164 4.9589 13.2364 5.09779 13.3107 5.26158C13.3851 5.42537 13.4106 5.60712 13.3843 5.78506C13.3581 5.963 13.281 6.12959 13.1625 6.26488L8.67514 11.3922C8.58732 11.4927 8.47901 11.5732 8.3575 11.6284C8.23598 11.6836 8.10406 11.7122 7.9706 11.7122C7.83714 11.7122 7.70522 11.6836 7.5837 11.6284C7.46219 11.5732 7.35388 11.4927 7.26606 11.3922V11.3931Z"
                    fill="white" />
            </svg>
        </div>
        <!-- Form Add to Cart -->
        <form method="POST" action="{{ route('cart.add') }}"
            class="flex flex-col gap-3 px-3 py-3 rounded-b-lg content-body bg-secondary-accent-color">
            @csrf
            <!-- Informasi Menu -->
            <input class="text-lg text-white bg-transparent outline-none" readonly
                value="{{ $menuDetails->name ?? '' }}" disabled>

            @if ($selectedProperty)
                <div class="flex items-center gap-2 wrap">
                    <p class="text-lg">SIZE : </p>
                    <input name="size" class="text-lg text-white uppercase bg-transparent outline-none" readonly
                        value="{{ $selectedProperty->size ?? '' }}">
                </div>
            @else
                <p>SIZE: Not selected</p>
            @endif

            <!-- Input Hidden Menu ID -->
            <input type="hidden" name="menu_ID" value="{{ $menuDetails->menu_ID ?? '' }}">
            <!-- Input Hidden Customer ID -->
            <input type="hidden" name="customer_ID" value="{{ Auth::user()->customer_ID ?? '' }}">
            <!-- Input Hidden Quantity -->
            <input type="hidden" name="quantity" id="hidden-quantity" value="1">
            <!-- Informasi Harga -->
            <p class="text-highlight-content">Max. Pembelian 2 pcs!</p>

            @if ($selectedProperty)
                <div class="flex items-center justify-between gap-2 wrap">
                    <p>SUBTOTAL</p>
                    <p id="subtotal">Rp {{ number_format($selectedProperty->price, 0, ',', '.') }}</p>
                </div>
            @else
                <p>SIZE: Not selected</p>
            @endif

            <!-- Tombol Add Quantity -->
            <div class="flex items-center justify-between gap-1 rounded-lg add-to-cart">
                <!-- Tombol Decrease -->
                <button id="decrease" type="button" class="gap-3 px-3 py-2.5 rounded-lg w-fit bg-secondary-color">
                    <svg height="24px" fill="white" viewBox="0 0 512 512" width="20px">
                        <path
                            d="M417.4,224H94.6C77.7,224,64,238.3,64,256c0,17.7,13.7,32,30.6,32h322.8c16.9,0,30.6-14.3,30.6-32C448,238.3,434.3,224,417.4,224z" />
                    </svg>
                </button>
                <!-- Tombol Add to Cart -->
                <button type="submit"
                    class="w-full gap-3 px-2 py-3 text-sm font-semibold rounded-lg 2xl:px-5 bg-secondary-color">
                    ADD TO CART <span>(<span id="quantity-display">1</span>)</span>
                </button>
                <!-- Tombol Increase -->
                <button id="increase" type="button" class="gap-3 px-3 py-2.5 rounded-lg w-fit bg-secondary-color">
                    <svg height="24px" fill="white" viewBox="0 0 512 512" width="20px">
                        <path
                            d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32C448,238.3,434.3,224,417.4,224z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decreaseButton = document.getElementById('decrease');
        const increaseButton = document.getElementById('increase');
        const quantityDisplay = document.getElementById('quantity-display');
        const hiddenQuantityInput = document.getElementById('hidden-quantity');
        const subtotalElement = document.getElementById('subtotal');
        const pricePerItem = {{ $selectedProperty->price }}; // Harga per item dari server-side

        let quantity = 1; // Inisialisasi jumlah awal

        function updateValues() {
            quantityDisplay.textContent = quantity;
            hiddenQuantityInput.value = quantity;
            const subtotal = pricePerItem * quantity;
            subtotalElement.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
        }

        decreaseButton.addEventListener('click', function() {
            if (quantity > 1) {
                quantity--;
                updateValues();
            }
        });

        increaseButton.addEventListener('click', function() {
            if (quantity < 2) {
                quantity++;
                updateValues();
            }
        });

        updateValues();
    });
</script>
