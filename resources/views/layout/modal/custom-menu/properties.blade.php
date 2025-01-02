<dialog id="modal-add-properties" class="relative m-auto rounded-lg w-[30%] ">
    <div class="flex items-center justify-center w-full h-full p-16 rounded-lg card-content">
        <div class="flex flex-col w-full gap-16 wrap">
            @isset($detailCategories)
                <form class="flex flex-col w-full gap-3"
                    action="{{ route('custom.properties.store', ['id' => $detailCategories->categories_ID]) }}"
                    method="POST">
                    @csrf
                    <input type="text" name="properties_name"
                        class="w-full p-2 text-base rounded-lg outline outline-1 outline-secondary-accent-color"
                        placeholder="Add new Toppings" required />
                    <input type="number" name="price"
                        class="w-full p-2 text-base rounded-lg outline outline-1 outline-secondary-accent-color"
                        placeholder="Price" required />
                    <button type="submit" class="w-full p-2 text-white rounded-lg bg-secondary-accent-color">
                        Insert
                    </button>
                </form>
            @else
                <h6>Please Select a Categories First</h6>
            @endisset
        </div>
    </div>
    <!-- Close Button -->
    <button id="close-btn-properties" class="absolute right-3 top-1 text-secondary-accent-color">
        <i class="text-2xl ti ti-x"></i>
    </button>
</dialog>
<script>
    const modalProp = document.getElementById("modal-add-properties");
    const toggleProp = document.getElementById("btn-add-properties");
    const toggleCloseProp = document.getElementById("close-btn-properties");

    // Add event listeners
    toggleProp.addEventListener("click", () => {
        modalProp.showModal();
        document.body.classList.add("overflow-hidden");
    });

    toggleCloseProp.addEventListener("click", () => {
        modalProp.close();
        document.body.classList.remove("overflow-hidden");
    });

    // Add event listener for clicks outside the modal to close it
    modalProp.addEventListener("click", (event) => {
        if (event.target === modal) {
            modalProp.close();
            document.body.classList.remove("overflow-hidden");
        }
    });

    // The previous condition was not working correctly because it would only run once
    // Instead, you can use the dialog's 'open' event
    modalProp.addEventListener("open", () => {
        document.body.classList.add("overflow-hidden");
    });

    modalProp.addEventListener("close", () => {
        document.body.classList.remove("overflow-hidden");
    });
</script>
