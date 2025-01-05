<header class="px-6 py-6 rounded-xl bg-primary-color-admin">
    <nav class="flex items-center justify-between text-lg font-medium">
        <div class="relative flex items-center gap-4 user">
            <img src="https://png.pngtree.com/background/20230426/original/pngtree-happy-old-man-wearing-glasses-is-smiling-picture-image_2485948.jpg"
                alt="" class="object-cover w-10 h-10 rounded-full" />
            <button id="toggle-profile-box" class="flex items-center gap-3 text-gray-500">Super Admin <i
                    class="text-lg font-semibold ti ti-chevron-down"></i></button>
            <div id="box-admin-profile"
                class="w-[13rem] bg-secondary-accent-color-admin  z-50 hidden absolute left-0 top-14 rounded-lg p-4 bg-wh backdrop-blur-2xl h-fit outline outline-1 outline-black">
                <div class="flex flex-col gap-3 uppercase wrap">
                    <a href=""
                        class="flex items-center gap-3 p-2 text-sm font-semibold text-black transition-all duration-300 ease-in-out rounded-lg hover:bg-gray-300 "><i
                            class="text-lg ti ti-edit"></i> Profile</a>
                    <a href=""
                        class="flex items-center gap-3 p-2 text-sm font-semibold text-black transition-all duration-300 ease-in-out rounded-lg hover:bg-gray-300"><i
                            class="text-lg ti ti-logout-2"></i> Log Out</a>
                </div>
            </div>
        </div>
        <!-- middle Content -->
        <div class="middle-quick-link">
            <ul class="flex items-center gap-2">
                <li class="relative group">
                    <a href="/dashboard"
                        class="!text-accent-color-admin px-6 flex items-center gap-3 nav-toggle py-2 rounded-full outline-1 outline-gray-300">
                        <i class="text-2xl ti ti-layout-dashboard"></i>Dashboard</a>
                </li>
                <li class="relative group">
                    <a href="/admin/product"
                        class="px-6 py-2 rounded-full flex items-center gap-3 !text-accent-color-admin nav-toggle outline-1 outline-gray-300">
                        <i class="text-2xl ti ti-tools-kitchen-2"></i>
                        Menu</a>
                </li>
                <li class="relative group">
                    <a href="/admin/menu/custom/order"
                        class="px-6 py-2 rounded-full flex items-center gap-3 !text-accent-color-admin nav-toggle outline-1 outline-gray-300">
                        <i class="text-2xl rotate-180 ti ti-pizza"></i>
                        Custom Pizza</a>
                </li>
                <li class="relative group">
                    <a href="/Customer"
                        class="!text-accent-color-admin flex items-center gap-3 nav-toggle px-6 py-2 rounded-full outline-1 outline-gray-300"><i
                            class="text-2xl ti ti-users"></i>Customers</a>
                </li>
                <li class="relative group">
                    <a href="/contactUS/CS/Admin"
                        class="!text-accent-color-admin flex items-center gap-3 nav-toggle px-6 py-2 rounded-full outline-1 outline-gray-300">
                        <i class="text-2xl ti ti-headset"></i>Customer Service</a>
                </li>
                <li class="relative group">
                    <a href="/admin/menu/order"
                        class="!text-accent-color-admin flex items-center gap-3 nav-toggle px-6 py-2 rounded-full outline-1 outline-gray-300"><i
                            class="text-2xl ti ti-checkup-list"></i>Transaction</a>
                </li>
            </ul>
        </div>
        <!-- middle Content End -->
    </nav>
</header>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Create an instance of Notyf
    const notyf = new Notyf({
        duration: 1000,
        position: {
            x: 'right',
            y: 'top',
        },
        types: [{
                type: 'warning',
                background: 'orange',
                color: 'white', // Set text color to white
                icon: {
                    className: 'material-icons',
                    tagName: 'i',
                    text: 'warning',
                },
            },
            {
                type: 'success',
                background: '#2ECC71',
                duration: 10000,
                dismissible: true,
                color: 'white', // Set text color to white
            },
            {
                type: 'error',
                background: 'indianred',
                duration: 10000,
                dismissible: true,
                color: 'white', // Set text color to white
            },
        ],
    });

    // Display error notifications if there are any
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            notyf.error("{{ $error }}");
        @endforeach
    @endif

    // Display a success notification if there is a success message in the session
    @if (session('success'))
        notyf.success("{{ session('success') }}");
    @endif
</script>
<script>
    const toggleProfile = document.getElementById("toggle-profile-box"); // Corrected the method name
    const box = document.getElementById("box-admin-profile"); // Corrected the method name

    toggleProfile.addEventListener("click", function() {
        // Corrected event listener syntax
        box.classList.toggle("hidden"); // Toggle the "hidden" class when the toggle button is clicked
    });
</script>
