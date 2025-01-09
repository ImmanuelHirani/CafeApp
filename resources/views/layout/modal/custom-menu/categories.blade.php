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
                                Your First Menu
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('custom.categories.store') }}" method="POST">
                @csrf
                <div id="form1" class="gap-3 bg-white rounded-lg tabs-content">
                    <div class="flex flex-col gap-3 wrap">
                        <input type="hidden" required name="form_target[]" value="controller1">
                        <input type="text" name="from1[categories]"
                            class="w-full p-2 rounded-lg outline outline-2 outline-secondary-accent-color bg-secondary-accent-color-admin"
                            placeholder="Enter New Category" required>
                        <label
                            class="w-full p-3 text-center text-white rounded-lg cursor-pointer bg-secondary-accent-color next-tabs">Next</label>
                    </div>
                </div>
                <div id="form2" class="flex flex-col gap-3 rounded-lg tabs-content">
                    <!-- Input grup properti -->
                    <div class="flex flex-col gap-3">
                        <input type="text" name="properties_name[]"
                            class="w-full p-2 text-base rounded-lg outline outline-1 outline-secondary-accent-color"
                            placeholder="Add new Toppings" required>
                        <input type="number" name="price[]"
                            class="w-full p-2 text-base rounded-lg outline outline-1 outline-secondary-accent-color"
                            placeholder="Price" required>
                    </div>
                    <!-- Submit -->
                    <button type="submit"
                        class="p-3 text-white rounded-lg cursor-pointer bg-secondary-accent-color">Insert</button>
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
