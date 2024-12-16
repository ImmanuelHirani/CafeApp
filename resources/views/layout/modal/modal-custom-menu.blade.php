<dialog id="modal-add-product" class="relative m-auto ">
    <div class="flex items-center justify-center w-full h-full p-6 card-content">
        <div class="flex flex-col gap-16 wrap">
            <div class="flex flex-col gap-6 wrap">
                <h6 class="font-semibold text-center">Created Custom Menu</h6>
                <div class="flex items-center justify-center w-full gap-3 proggres-line">
                    <div class="flex items-center gap-3 line-wrap">
                        1
                        <div class="relative flex wrap">
                            <div class="w-[20rem] h-2 rounded-lg line bg-secondary-accent-color"></div>
                            <p class="absolute text-sm font-semibold uppercase translate-x-1/2 top-4 right-1/2">
                                Categories
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 line-wrap">
                        2
                        <div class="relative flex wrap">
                            <div class="w-[20rem] h-2 rounded-lg line bg-secondary-accent-color"></div>
                            <p class="absolute text-sm font-semibold uppercase translate-x-1/2 top-4 right-1/2">
                                Size & Price & Flavor
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('custom.categories.store') }}" method="POST">
                @csrf
                <div id="form1" class="gap-3 bg-white rounded-lg tabs-content">
                    <div class="flex flex-col gap-3 wrap">
                        <input type="hidden" name="form_target[]" value="controller1">
                        <input type="text" name="from1[categories]"
                            class="w-full p-2 rounded-lg outline outline-2 outline-secondary-accent-color bg-secondary-accent-color-admin"
                            placeholder="Enter New Category">
                        <label
                            class="w-full p-3 text-center text-white rounded-lg cursor-pointer bg-secondary-accent-color next-tabs">Next</label>
                    </div>
                </div>
                <div id="form2" class="flex flex-col gap-3 rounded-lg tabs-content">
                    <!-- Input grup pertama -->
                    <div class="flex items-center w-full gap-3 wrap">
                        <input name="size[]" placeholder="Size"
                            class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]">
                        <input type="text" name="price[]" placeholder="Price"
                            class="w-full p-3 text-center rounded-lg outline outline-2 outline-secondary-accent-color bg-secondary-accent-color-admin">
                        <p>Allowed Flavor : </p>
                        <input name="allowed_flavor[]"
                            class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]">
                    </div>
                    <div class="flex items-center w-full gap-3 wrap">
                        <input name="size[]" placeholder="Size"
                            class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]">
                        <input type="text" name="price[]" placeholder="Price"
                            class="w-full p-3 text-center rounded-lg outline outline-2 outline-secondary-accent-color bg-secondary-accent-color-admin">
                        <p>Allowed Flavor : </p>
                        <input name="allowed_flavor[]"
                            class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]">
                    </div>
                    <div class="flex items-center w-full gap-3 wrap">
                        <input name="size[]" placeholder="Size"
                            class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]">
                        <input type="text" name="price[]" placeholder="Price"
                            class="w-full p-3 text-center rounded-lg outline outline-2 outline-secondary-accent-color bg-secondary-accent-color-admin">
                        <p>Allowed Flavor : </p>
                        <input name="allowed_flavor[]"
                            class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]">
                    </div>
                    <div class="flex items-center w-full gap-3 wrap">
                        <input name="size[]" placeholder="Size"
                            class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]">
                        <input type="text" name="price[]" placeholder="Price"
                            class="w-full p-3 text-center rounded-lg outline outline-2 outline-secondary-accent-color bg-secondary-accent-color-admin">
                        <p>Allowed Flavor : </p>
                        <input name="allowed_flavor[]"
                            class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]">
                    </div>
                    <!-- Submit -->
                    <button type="submit"
                        class="p-3 text-white rounded-lg cursor-pointer bg-secondary-accent-color ">Insert</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Close Button -->
    <button id="close-btn" class="absolute right-3 top-3 text-secondary-accent-color">
        <i class="text-2xl ti ti-x"></i>
    </button>
</dialog>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const tabs = document.querySelectorAll(".tabs-content");
        const buttons = document.querySelectorAll(".tabs-content .next-tabs");
        const lines = document.querySelectorAll(".proggres-line .line");

        // Pastikan semua tab selain tab pertama disembunyikan di awal
        tabs.forEach((tab, index) => {
            if (index !== 0) {
                tab.style.display = "none";
            }
        });

        // Update status garis progres
        const updateProgressLine = (activeIndex) => {
            lines.forEach((line, index) => {
                if (index <= activeIndex) {
                    line.classList.add("active");
                } else {
                    line.classList.remove("active");
                }
            });
        };

        // Pastikan hanya garis pertama yang aktif di awal
        updateProgressLine(0);

        buttons.forEach((button, index) => {
            button.addEventListener("click", (event) => {
                event.preventDefault();

                // Sembunyikan tab saat ini
                tabs[index].style.display = "none";

                // Tampilkan tab berikutnya jika ada
                if (index + 1 < tabs.length) {
                    tabs[index + 1].style.display = "flex";

                    // Update garis progres
                    updateProgressLine(index + 1);
                }
            });
        });
    });
</script>
