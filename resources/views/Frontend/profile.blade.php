<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Draggable.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" /> -->
    @vite('resources/css/app.css')
</head>

<body>
    @include('layout.Navbar')
    <main>
        <section class="container grid grid-cols-12 gap-6 mt-20 auto-rows-[100%] profile font-aesthetnova">
            <div class="sticky col-span-4 overflow-hidden top-36 h-fit rounded-2xl bg-secondary-accent-color">
                <div class="flex flex-col profile">
                    <div class="flex items-center pt-4 header">
                        <div class="flex items-center gap-12 px-8 rounded-lg wrap">
                            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://salonlfc.com/wp-content/uploads/2018/01/image-not-found-1-scaled.png' }}"
                                class="object-cover rounded-full w-[3.5rem] h-[3.5rem]" alt="">
                            <p class="text-xl 3xl:text-2xl line-clamp-1">
                                {{ Auth::user()->username ?? 'Not Set Username Yet' }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 py-6 body">
                        <hr class="border-4 border-primary-color">
                        <div class="relative flex items-center gap-12 px-12 cursor-pointer wrap group ">
                            <div
                                class="absolute left-0 h-[4.4rem] w-[0.8rem] line transition-all ease-in-out duration-300 group-hover:bg-secondary-color">
                            </div>
                            <i class="text-4xl w-[13%] text-white ti ti-user-circle"></i>
                            <p class="text-xl 3xl:text-2xl w-[77%]">Account Overview</p>
                        </div>
                        <hr class="border-4 border-primary-color">
                        <div class="relative flex items-center gap-12 px-12 cursor-pointer wrap group ">
                            <div
                                class="absolute left-0 h-[4.4rem] w-[0.8rem] line transition-all ease-in-out duration-300 group-hover:bg-secondary-color">
                            </div>
                            <i class="text-4xl w-[13%] text-white ti ti-clipboard-list"></i>
                            <p class="text-xl 3xl:text-2xl w-[77%]">My Order</p>
                        </div>
                        <hr class="border-4 border-primary-color">
                        <div class="relative flex items-center gap-12 px-12 cursor-pointer wrap group ">
                            <div
                                class="absolute left-0 h-[4.4rem] w-[0.8rem] line transition-all ease-in-out duration-300 group-hover:bg-secondary-color">
                            </div>
                            <i class="text-4xl w-[13%] text-white ti ti-shopping-bag-heart"></i>
                            <p class="text-xl 3xl:text-2xl w-[77%]">Wishlist</p>
                        </div>
                        <hr class="border-4 border-primary-color">
                        <label for="logout" type="submit"
                            class="relative flex items-center gap-12 px-12 cursor-pointer wrap group ">
                            <div
                                class="absolute left-0 h-[4.4rem] w-[0.8rem] line transition-all ease-in-out duration-300 group-hover:bg-secondary-color">
                            </div>
                            <i class="text-4xl w-[13%] text-white ti ti-logout-2"></i>
                            <p class="text-xl 3xl:text-2xl w-[77%]">Log Out</p>
                        </label>
                        <form action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                            <input type="submit" class="hidden" id="logout">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-span-8 overflow-hidden rounded-2xl bg-secondary-accent-color">
                <div class="banner">
                    <img src="{{ asset('asset/Banner-profile.png') }}" alt="">
                </div>
                <div class="flex flex-col gap-4 p-6 3xl:p-12 body">
                    <div class="profile">
                        <p class="text-2xl">Profile</p>
                    </div>
                    <hr>
                    <form enctype="multipart/form-data" method="POST"
                        action="{{ Route('profile.update', Auth::user()->customer_ID) }}"
                        class="grid items-center w-full grid-cols-6 gap-16 my-3 profile-wrap">
                        @csrf
                        @method('put')
                        <div class="flex flex-col w-full col-span-4 gap-6 wrap">
                            <div class="flex items-center w-full text-white wrap">
                                <label for="username" class="text-lg w-[30%]">Username</label>
                                <input name="username" id="username" type="text" placeholder="Max 20 Char"
                                    value="{{ Auth::user()->username ?? 'Not Set Username Yet' }}"
                                    class="w-[70%] px-4 py-2 text-gray-500 rounded-lg">
                            </div>
                            <div class="flex items-center w-full text-white wrap">
                                <label for="email" class="text-lg w-[30%]">Email</label>
                                <input name="email" id="email" type="text" placeholder="Email"
                                    value="{{ Auth::user()->email ?? 'Not Set Email Yet' }}"
                                    class="w-[70%] px-4 py-2 text-gray-500 rounded-lg">
                            </div>
                            <div class="flex items-center w-full text-white wrap">
                                <label for="phone" class="text-lg w-[30%]">Phone</label>
                                <input name="phone" id="phone" type="text" placeholder="Phone Number"
                                    value="{{ Auth::user()->phone ?? 'Not Set Phone Yet' }}"
                                    class="w-[70%] px-4 py-2 text-gray-500 rounded-lg">
                            </div>
                            <button type="submit" class="self-end px-8 py-2 bg-green-600 rounded-lg w-fit">Update
                                Data</button>
                        </div>
                        <div class="flex justify-center w-full col-span-2">
                            <div class="flex flex-col items-center gap-6 wrap">
                                <img class="w-[8rem] h-[8rem] rounded-full object-cover img-preview"
                                    src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://salonlfc.com/wp-content/uploads/2018/01/image-not-found-1-scaled.png' }}"
                                    alt="Image Preview">
                                <input name="image" id="file" type="file" class="hidden file-img-product">
                                <label for="file"
                                    class="px-8 py-2 text-white rounded-lg cursor-pointer h-fit w-fit outline-1 outline outline-white">Pilih
                                    Gambar</label>
                                <p class="hidden text-red-500 error-message">File harus berupa gambar dengan format
                                    .JPEG, .PNG, atau .JPG</p>
                            </div>

                        </div>
                    </form>
                    <hr>
                    <div class="flex items-center justify-between location">
                        <p class="text-2xl">My Location <span class="text-highlight-content">(Max 2)</span> </p>
                        <button id="locationTrigger" class="self-end px-8 py-2 bg-green-600 rounded-lg w-fit">Add
                            Location</button>
                    </div>
                    <div class="flex flex-col items-center w-full gap-6 my-3 location-wrap">
                        @if ($customer->locationCustomer->isNotEmpty())
                            @foreach ($customer->locationCustomer as $location)
                                <div
                                    class="w-full p-6 border-[2.5px] flex flex-col gap-3 border-red-800 rounded-lg
                                @if ($location->is_primary == 1) bg-secondary-color bg-opacity-40 @endif
                                location-box">
                                    <div class="w-full space-y-2 header">
                                        <button
                                            class="px-8 py-2 text-sm rounded-full text-balance bg-primary-color text-highlight-content outline outline-1 outline-highlight-content">
                                            {{ $location->location_label }}
                                        </button>
                                        <p>{{ $location->reciver_name }} | ({{ $location->reciver_number }})</p>
                                    </div>
                                    <div class="flex justify-between gap-3 body">
                                        <div class="wrap w-[60%] flex flex-col gap-3">
                                            <p>{{ $location->reciver_address }}</p>
                                            <div class="flex items-center gap-3 wrap">
                                                <button
                                                    class="text-center w-[6rem] py-1.5 bg-green-600 rounded-lg">Edit</button>
                                                <button
                                                    class="text-center w-[6rem] py-1.5 bg-red-500 rounded-lg">Delete</button>
                                            </div>
                                        </div>
                                        <div class="check-status w-[40%] text-end">
                                            @if ($location->is_primary == 1)
                                                <i class="text-2xl text-secondary-color ti ti-check text-end"></i>
                                            @else
                                                <form
                                                    action="{{ Route('profile.location.primary', $location->location_ID) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <button
                                                        class="px-8 py-2 text-white bg-green-600 rounded-lg">Choose</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No location available</p>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Review Box Wrapper -->
    @include('layout.modal.modal-location')
    @include('layout.Sidebar')
    @include('layout.Footer')
</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="{{ asset('/js/swiper.js') }}"></script>
<script src="{{ asset('/js/GSAP.js') }}"></script>
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<script src="{{ asset('/js/sidebar.js') }}"></script>
<script src="{{ asset('/js/boxLogin.js') }}"></script>
<script src="{{ asset('/js/imgPicker.js') }}"></script>
<script>
    const locationTrigger = document.getElementById("locationTrigger"),
        locationBox = document.getElementById("locationBox"),
        closelocation = document.getElementById("closelocation");

    locationTrigger.addEventListener("click", () => {
        locationTrigger.classList.add("trigger-active-location");
        locationBox.classList.add("box-active-location");
    });

    closelocation.addEventListener("click", () => {
        locationTrigger.classList.remove("trigger-active-location");
        locationBox.classList.remove("box-active-location");
    });
</script>

</html>
