<header class="px-6 py-6 rounded-xl bg-primary-color-admin">
    <nav class="flex items-center justify-between text-lg font-medium">
        <div class="flex items-center gap-4 user">
            <img src="https://png.pngtree.com/background/20230426/original/pngtree-happy-old-man-wearing-glasses-is-smiling-picture-image_2485948.jpg"
                alt="" class="object-cover w-10 h-10 rounded-full" />
            <p>Super Admin</p>
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
                    <a href="/Customer"
                        class="!text-accent-color-admin flex items-center gap-3 nav-toggle px-6 py-2 rounded-full outline-1 outline-gray-300">
                        <i class="text-2xl ti ti-headset"></i>Customers Service</a>
                </li>
                <li class="relative group">
                    <a href="/admin/menu/order"
                        class="!text-accent-color-admin flex items-center gap-3 nav-toggle px-6 py-2 rounded-full outline-1 outline-gray-300"><i
                            class="text-2xl ti ti-checkup-list"></i>Orders</a>
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
