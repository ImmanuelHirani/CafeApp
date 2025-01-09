<header class="px-6 py-6 rounded-xl bg-primary-color-admin">
    <nav class="flex items-center justify-between text-lg font-medium">
        <div class="relative flex items-center gap-4 user">
            <img src="https://png.pngtree.com/background/20230426/original/pngtree-happy-old-man-wearing-glasses-is-smiling-picture-image_2485948.jpg"
                alt="" class="object-cover w-10 h-10 rounded-full" />
            <button id="toggle-profile-box" class="flex items-center gap-3 text-gray-500">Admin<i
                    class="text-lg font-medium ti ti-chevron-down"></i></button>
            <div id="box-admin-profile"
                class="w-[13rem] bg-secondary-accent-color-admin  z-50 hidden absolute left-0 top-14 rounded-lg p-2 bg-wh backdrop-blur-2xl h-fit outline outline-1 outline-black">
                <div class="flex flex-col gap-1 uppercase wrap">
                    <a href="/admin/profile"
                        class="flex items-center gap-3 p-2 text-sm font-medium text-black transition-all duration-300 ease-in-out rounded-lg hover:bg-gray-300 "><i
                            class="text-lg ti ti-edit"></i> Profile</a>
                    <form action="{{ route('logout.admin') }}" method="POST" class=""
                        class="flex items-center gap-3 p-2 font-medium text-black transition-all duration-300 ease-in-out rounded-lg hover:bg-gray-300 ">
                        @csrf

                        <button type="submit"
                            class="flex items-center w-full gap-3 p-2 text-sm font-medium text-black uppercase transition-all duration-300 ease-in-out rounded-lg cursor-pointer hover:bg-gray-300 ">
                            <i class="text-lg ti ti-logout-2"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- middle Content -->
        <div class="middle-quick-link">
            <ul class="flex items-center gap-10">
                <li class="relative group">
                    <a href="/dashboard"
                        class="!text-accent-color-admin  flex items-center gap-3 nav-toggle py-2 rounded-full outline-1 outline-gray-300">
                        <i class="text-2xl ti ti-layout-dashboard"></i>Dashboard</a>
                </li>
                <li class="relative group">
                    <a href="/admin/product"
                        class=" py-2 rounded-full flex items-center gap-3 !text-accent-color-admin nav-toggle outline-1 outline-gray-300">
                        <i class="text-2xl ti ti-tools-kitchen-2"></i>
                        Menu</a>
                </li>
                <li class="relative group">
                    <a href="/admin/menu/custom/order"
                        class=" py-2 rounded-full flex items-center gap-3 !text-accent-color-admin nav-toggle outline-1 outline-gray-300">
                        <i class="text-2xl rotate-180 ti ti-pizza"></i>
                        Custom Pizza</a>
                </li>
                <li class="relative group">
                    <a href="/Customer"
                        class="!text-accent-color-admin flex items-center gap-3 nav-toggle py-2 rounded-full outline-1 outline-gray-300"><i
                            class="text-2xl ti ti-users"></i>Customers</a>
                </li>
                <li class="relative group">
                    <a href="/Admin/User"
                        class="!text-accent-color-admin flex items-center gap-3 nav-toggle py-2 rounded-full outline-1 outline-gray-300">
                        <i class="text-2xl ti ti-user-shield"></i>
                        Admin</a>
                </li>
                <li class="relative group">
                    <a href="/contactUS/CS/Admin"
                        class="!text-accent-color-admin flex items-center gap-3 nav-toggle py-2 rounded-full outline-1 outline-gray-300">
                        <i class="text-2xl ti ti-headset"></i>Customer Service</a>
                </li>
                <li class="relative group">
                    <a href="/admin/menu/order"
                        class="!text-accent-color-admin flex items-center gap-3 nav-toggle  py-2 rounded-full outline-1 outline-gray-300"><i
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
        duration: 3000,
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
                duration: 1000,
                dismissible: true,
                color: 'white', // Set text color to white
            },
            {
                type: 'error',
                background: 'indianred',
                duration: 1000,
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

    @if (session('error'))
        notyf.error("{{ session('error') }}");
    @endif

    // Display a success notification if there is a success message in the session
    @if (session('success'))
        notyf.success("{{ session('success') }}");
    @endif
</script>
<script>
    const toggleProfile = document.getElementById("toggle-profile-box");
    const box = document.getElementById("box-admin-profile");

    // Toggle box visibility on button click
    toggleProfile.addEventListener("click", function(event) {
        event.stopPropagation(); // Prevent click event from propagating to document
        box.classList.toggle("hidden");
    });

    // Close box when clicking outside of it
    document.addEventListener("click", function(event) {
        if (!box.contains(event.target) && !toggleProfile.contains(event.target)) {
            // If click is outside the box and the toggle button
            box.classList.add("hidden");
        }
    });
</script>
