<div class="hidden col-span-3 row-span-2 transition-all duration-300 ease-in-out md:block">
    <div class="sticky transition-all duration-300 ease-in-out top-36 box-cart font-aesthetnova">
        <div class="flex items-center justify-between px-3 py-3 rounded-t-lg header bg-secondary-color">
            <p class="text-base 3xl:text-lg">Set Quantity & Order Details</p>
        </div>
        <!-- Form Add to Cart -->
        <form method="POST" action="{{ route('cart.add') }}"
            class="flex flex-col gap-3 px-3 py-3 rounded-b-lg content-body bg-secondary-accent-color">
            @csrf
            <!-- Informasi Menu -->
            <input class="text-lg text-white bg-transparent outline-none line-clamp-1" readonly
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
            @auth
                <input type="hidden" name="user_ID" value="{{ Auth::user()->user_ID }}">
            @endauth
            <!-- Input Hidden Quantity -->
            <input type="hidden" name="quantity" id="hidden-quantity" value="1">
            <!-- Informasi Harga -->
            <p class="text-highlight-content">Max. Purchase 2 pcs!</p>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil semua tombol ukuran
        const sizeButtons = document.querySelectorAll("button[data-size]");
        const subtotalElement = document.querySelector("#subtotal");
        const sizeInput = document.querySelector("input[name='size']");

        sizeButtons.forEach((button) => {
            button.addEventListener("click", function() {
                const size = this.getAttribute("data-size");
                const menuID = this.getAttribute("data-menu-id");

                // Tambahkan efek loading (opsional)
                button.classList.add("loading");

                // Kirim request ke server
                fetch(`/menu/details/ajax`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]').getAttribute("content"),
                        },
                        body: JSON.stringify({
                            menu_ID: menuID,
                            size
                        }),
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        // Update harga dan input size
                        if (data.success) {
                            subtotalElement.textContent = `Rp ${data.price}`;
                            sizeInput.value = data.size;
                        } else {
                            alert(data.message || "Failed to update size");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        alert("An error occurred. Please try again.");
                    })
                    .finally(() => {
                        button.classList.remove("loading");
                    });
            });
        });
    });
</script>
