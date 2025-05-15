<dialog id="modal-custom-detail" class="relative font-aesthetnova m-auto rounded-lg   md:w-[45%] w-[90%] h-fit">

    <div
        class="flex flex-col items-center justify-center w-full h-full gap-3 p-4 border-2 rounded-lg md:p-2 md:gap-6 md:flex-row border-highlight-content bg-secondary-accent-color card-content">
        <div class="w-full h-full wrap">
            <img src="{{ asset('asset/CustomOrder.png') }}" class="object-cover w-full md:h-full h-[10rem] rounded-lg "
                alt="" />
        </div>
        <div class="flex flex-col w-full gap-3 wrap">
            <p class="text-lg">Toppings-added: </p>
            <div class="flex flex-wrap items-center w-full gap-1 wrap">
                @isset($toppings)
                    @foreach ($toppings as $topping)
                        <label
                            class="px-4 py-2 text-base text-center rounded-full w-fit bg-primary-color text-highlight-content">
                            {{ $topping }}
                        </label>
                    @endforeach
                @endisset

            </div>
        </div>
    </div>

    <!-- Close Button -->
    <button id="close-btn-custom"
        class="absolute px-2 py-1 rounded-full bg-secondary-accent-color right-3 top-3 text-secondary-color">
        <i class="text-2xl ti ti-x"></i>
    </button>
</dialog>

<script>
    const modalcustomDetail = document.getElementById("modal-custom-detail");
    const togglecustomDetail = document.getElementById("btn-see-detail-custom");
    const toggleClosecustomDetail = document.getElementById("close-btn-custom");

    togglecustomDetail.addEventListener("click", () => {
        const transactionID = togglecustomDetail.dataset.customPizza;

        fetch(`/transaction_details/custom-details/${transactionID}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    const toppingsContainer = modalcustomDetail.querySelector('.wrap .flex-wrap');
                    toppingsContainer.innerHTML = ''; // Clear previous toppings

                    // Add each topping to the container
                    data.toppings.forEach(topping => {
                        const label = document.createElement('label');
                        label.className =
                            'px-4 py-2 text-base text-center rounded-full w-fit bg-primary-color text-highlight-content';
                        label.textContent = topping;
                        toppingsContainer.appendChild(label);
                    });

                    modalcustomDetail.showModal();

                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error fetching custom details:', error);
                alert('Failed to fetch custom details. Please try again.');
            });
    });

    toggleClosecustomDetail.addEventListener("click", () => {
        modalcustomDetail.close();

    });

    modalcustomDetail.addEventListener("click", (event) => {
        if (event.target === modalcustomDetail) {
            modalcustomDetail.close();

        }
    });
</script>
