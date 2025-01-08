<dialog id="modal-custom-detail" class="relative m-auto rounded-lg w-[30%] ">
    <div class="flex items-center justify-center w-full h-full p-8 rounded-lg card-content">
        <div class="flex flex-col w-full gap-16 wrap">
            <form method="POST" action="{{ route('custom.categories.customDetail.store') }}"
                class="flex flex-col gap-3 rounded-lg ">
                @csrf
                <!-- Input grup pertama -->
                <div class="flex items-center w-full gap-3 wrap">
                    <input name="customDetail[]" value="sm" placeholder="customDetail"
                        class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]" />
                    <input type="text" name="price[]" placeholder="Price"
                        class="w-full p-3 text-center rounded-lg outline outline-2 outline-secondary-accent-color bg-secondary-accent-color-admin" />
                    <p>Allowed Flavor :</p>
                    <input name="allowed_flavor[]" value="3"
                        class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]" />
                </div>
                <!-- Tambahan input grup berikutnya -->
                <div class="flex items-center w-full gap-3 wrap">
                    <input name="customDetail[]" value="md" placeholder="customDetail"
                        class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]" />
                    <input type="text" name="price[]" placeholder="Price"
                        class="w-full p-3 text-center rounded-lg outline outline-2 outline-secondary-accent-color bg-secondary-accent-color-admin" />
                    <p>Allowed Flavor :</p>
                    <input name="allowed_flavor[]" value="5"
                        class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]" />
                </div>
                <div class="flex items-center w-full gap-3 wrap">
                    <input name="customDetail[]" value="lg" placeholder="customDetail"
                        class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]" />
                    <input type="text" name="price[]" placeholder="Price"
                        class="w-full p-3 text-center rounded-lg outline outline-2 outline-secondary-accent-color bg-secondary-accent-color-admin" />
                    <p>Allowed Flavor :</p>
                    <input name="allowed_flavor[]" value="7"
                        class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]" />
                </div>
                <div class="flex items-center w-full gap-3 wrap">
                    <input name="customDetail[]" value="xl" placeholder="customDetail"
                        class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]" />
                    <input type="text" name="price[]" placeholder="Price"
                        class="w-full p-3 text-center rounded-lg outline outline-2 outline-secondary-accent-color bg-secondary-accent-color-admin" />
                    <p>Allowed Flavor :</p>
                    <input name="allowed_flavor[]" value="9"
                        class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]" />
                </div>
                <!-- Submit -->
                <button type="submit" class="p-3 text-white rounded-lg cursor-pointer bg-secondary-accent-color">
                    Insert
                </button>
            </form>
        </div>
    </div>
    <!-- Close Button -->
    <button id="close-btn-customDetail" class="absolute right-3 top-1 text-secondary-accent-color">
        <i class="text-2xl ti ti-x"></i>
    </button>
</dialog>
<script>
    const modalcustomDetail = document.getElementById("modal-custom-detail");
    const togglecustomDetail = document.getElementById("btn-see-detail-custom");
    const toggleClosecustomDetail = document.getElementById("close-btn-custom");

    // Add event listeners
    togglecustomDetail.addEventListener("click", () => {
        modalcustomDetail.showModal();
        document.body.classList.add("overflow-hidden");
    });

    toggleClosecustomDetail.addEventListener("click", () => {
        modalcustomDetail.close();
        document.body.classList.remove("overflow-hidden");
    });

    // Add event listener for clicks outside the modal to close it
    modalcustomDetail.addEventListener("click", (event) => {
        if (event.target === modal) {
            modalcustomDetail.close();
            document.body.classList.remove("overflow-hidden");
        }
    });

    // The previous condition was not working correctly because it would only run once
    // Instead, you can use the dialog's 'open' event
    modalcustomDetail.addEventListener("open", () => {
        document.body.classList.add("overflow-hidden");
    });

    modalcustomDetail.addEventListener("close", () => {
        document.body.classList.remove("overflow-hidden");
    });
</script>
