<div id="locationBoxUpdate"
    class="fixed inset-0 z-50 flex items-center justify-center invisible bg-black opacity-30 bg-opacity-70 box-review-wrapper font-aesthetnova">
    <!-- Modal Container -->
    <div
        class="review-box relative w-[90%] 3xl:w-[45%] md:w-[55%] h-fit md:h-fit bg-secondary-accent-color p-3 md:p-8 rounded-lg flex flex-col gap-3 items-center">
        <!-- Modal Title -->
        <p class="text-lg font-semibold text-center uppercase md:text-start md:text-xl">
            Update Location
        </p>
        <form id="locationFormUpdate" class="w-full"
            action="{{ route('profile.location.update', Auth::user()->customer_ID) }}" method="POST">
            @csrf
            @method('put')
            <div class="flex flex-col w-full gap-4 max-h-[25rem] md:p-4 px-1 py-3 overflow-y-auto">
                <!-- Location Label -->
                <div class="flex flex-col w-full gap-3 contet-wrap">
                    <p class="w-full text-lg text-start md:text-xl">Locations Place</p>
                    <div class="flex flex-wrap gap-3 wrap">
                        <input required type="text" id="locationInputUpdate" name="location_label"
                            class="w-full h-10 col-span-4 px-4 rounded-lg outline-none md:col-span-2 md:h-14"
                            placeholder="Required" value="{{ $location->location_label ?? '' }}" />
                        <button type="button" onclick="setLocationUpdate('House')"
                            class="px-6 py-1.5 border border-white rounded-lg md:py-3 w-fit md:px-16">
                            House
                        </button>
                        <button type="button" onclick="setLocationUpdate('Apartment')"
                            class="px-6 py-1.5 border border-white rounded-lg md:py-3 w-fit md:px-16">
                            Apartment
                        </button>
                        <button type="button" onclick="setLocationUpdate('Campus')"
                            class="px-6 py-1.5 border border-white rounded-lg md:py-3 w-fit md:px-16">
                            Campus
                        </button>
                        <button type="button" onclick="setLocationUpdate('Hotel')"
                            class="px-6 py-1.5 border border-white rounded-lg md:py-3 w-fit md:px-16">
                            Hotel
                        </button>
                        <button type="button" onclick="setLocationUpdate('Office')"
                            class="px-6 py-1.5 border border-white rounded-lg md:py-3 w-fit md:px-16">
                            Office
                        </button>
                        <button type="button" onclick="setLocationUpdate('Other')"
                            class="px-6 py-1.5 border border-white rounded-lg md:py-3 w-fit md:px-16">
                            Other
                        </button>
                    </div>
                </div>
                <!-- Receiver Address -->
                <div class="flex flex-col w-full gap-3 contet-wrap">
                    <p class="w-full text-lg text-start md:text-xl">Location Details</p>
                    <textarea required name="reciver_address" id="reciver_address"
                        class="w-full col-span-4 px-4 py-2 rounded-lg outline-none" rows="3" placeholder="Required">{{ $location->reciver_address ?? '' }}</textarea>
                </div>
                <!-- Receiver Name -->
                <div class="flex flex-col w-full gap-3 contet-wrap">
                    <p class="w-full text-lg text-start md:text-xl">Receiver Name</p>
                    <input required type="text" name="reciver_name" id="reciver_name"
                        class="w-full h-10 col-span-4 px-4 rounded-lg outline-none md:col-span-2 md:h-14"
                        placeholder="Required" value="{{ $location->reciver_name ?? '' }}" />
                </div>
                <!-- Phone Number -->
                <div class="flex flex-col w-full gap-3 contet-wrap">
                    <p class="w-full text-lg text-start md:text-xl">Phone Number</p>
                    <input required type="text" name="reciver_number" id="reciver_number"
                        class="w-full h-10 col-span-4 px-4 rounded-lg outline-none md:col-span-2 md:h-14"
                        placeholder="Required" value="{{ $location->reciver_number ?? '' }}" />
                </div>
            </div>
            <!-- Input tersembunyi untuk lokasiID -->
            <input type="hidden" name="locationID" id="locationID" value="">
            <input type="submit" id="buttonLocationUpdate" class="hidden">
        </form>
        <p class="text-highlight-content">Your location is protected and never shared without consent.</p>
        <label for="buttonLocationUpdate" type="button"
            class="w-full px-6 py-1.5 cursor-pointer text-white text-center bg-green-500 rounded-lg md:py-3 md:px-16">
            Update Location
        </label>
        <!-- Close Button -->
        <svg id="closelocationUpdate" xmlns="http://www.w3.org/2000/svg"
            class="absolute cursor-pointer right-4 md:top-6 top-4 md:right-6" width="20" height="20"
            viewBox="0 0 12 12" fill="none">
            <path
                d="M0.29289 0.29289C0.68342 -0.09763 1.31658 -0.09763 1.70711 0.29289L6 4.58579L10.2929 0.29289C10.6834 -0.09763 11.3166 -0.09763 11.7071 0.29289C12.0976 0.68342 12.0976 1.31658 11.7071 1.70711L7.4142 6L11.7071 10.2929C12.0976 10.6834 12.0976 11.3166 11.7071 11.7071C11.3166 12.0976 10.6834 12.0976 10.2929 11.7071L6 7.4142L1.70711 11.7071C1.31658 12.0976 0.68342 12.0976 0.29289 11.7071C-0.09763 11.3166 -0.09763 10.6834 0.29289 10.2929L4.58579 6L0.29289 1.70711C-0.09763 1.31658 -0.09763 0.68342 0.29289 0.29289Z"
                fill="#F8C055" />
        </svg>
    </div>
</div>
<script>
    function setLocationUpdate(value) {
        document.getElementById('locationInputUpdate').value = value;
    }
</script>
<script>
    const locationTriggersUpdate = document.querySelectorAll(".locationTriggerUpdate");
    const locationBoxUpdate = document.getElementById("locationBoxUpdate");
    const closeLocationUpdate = document.getElementById("closelocationUpdate");

    // Tambahkan event listener ke semua elemen "locationTriggerUpdate"
    locationTriggersUpdate.forEach(trigger => {
        trigger.addEventListener("click", function(event) {
            event.preventDefault();

            // Dapatkan URL dari atribut href
            const url = this.getAttribute("href");

            // Gunakan AJAX untuk mendapatkan data lokasi
            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    // Jika permintaan berhasil, isi data ke dalam form
                    document.getElementById('locationInputUpdate').value = response
                        .location_label;
                    document.getElementById('reciver_address').value =
                        response.reciver_address;
                    document.getElementById('reciver_name').value = response
                        .reciver_name;
                    document.getElementById('reciver_number').value = response
                        .reciver_number;
                    // Sisipkan ID lokasi pada input tersembunyi
                    document.getElementById('locationID').value = response
                        .location_ID;
                    // Tampilkan modal
                    locationBoxUpdate.classList.add("box-active-location-update");
                },
                error: function(xhr) {
                    // Jika ada error, tampilkan pesan ke konsol atau buat notifikasi
                    console.error(xhr.responseJSON.error ||
                        "Failed to fetch location data");
                    alert("Failed to fetch location data. Please try again.");
                }
            });
        });
    });

    // Event listener untuk tombol close
    closeLocationUpdate.addEventListener("click", () => {
        // Hapus kelas aktif dari modal
        locationBoxUpdate.classList.remove("box-active-location-update");
    });
</script>
