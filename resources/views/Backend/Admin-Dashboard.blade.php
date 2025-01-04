<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <!-- jQuery dan DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body id="Admin">
    @include('layout.header')
    @include('layout.Dashboard')
    <main class="grid grid-cols-10 gap-4 py-4">
        <section class="flex flex-col col-span-7 p-6 rounded-lg gap-9 bg-primary-color-admin">
            <div class="overflow-x-auto">
                <table id="orderTable" class="w-auto text-center border shadow-sm table-auto stripe">
                    <thead class="">
                        <tr>
                            <th class="px-4 py-2 text-sm font-medium text-gray-500 uppercase w-fit">
                                Order ID
                            </th>
                            <th class="px-4 py-2 text-sm font-medium text-gray-500 uppercase w-fit">
                                Customers
                            </th>
                            <th class="px-4 py-2 text-sm font-medium text-gray-500 uppercase w-fit">
                                Payment Amount
                            </th>
                            <th class="px-4 py-2 text-sm font-medium text-gray-500 uppercase w-fit">
                                Status
                            </th>
                            <th class="px-4 py-2 text-sm font-medium text-gray-500 uppercase w-fit">
                                Purchase Date
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($orderCustomers as $orderCustomer)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-base text-gray-900 whitespace-nowrap">
                                    {{ $orderCustomer->order_ID }}</td>
                                <td class="px-4 py-2 text-base text-gray-500 whitespace-nowrap">
                                    {{ $orderCustomer->customer->username ?? 'Not Set The Username Yet' }}
                                </td>
                                <td class="px-4 py-2 text-base text-secondary-accent-color whitespace-nowrap">
                                    Rp {{ number_format($orderCustomer->total_amounts, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <div class="w-[8rem] mx-auto py-2 text-center rounded-full status-order"
                                        data-status="{{ strtolower($orderCustomer->status_order) }}">
                                        {{ $orderCustomer->status_order }}
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-base text-gray-500 whitespace-nowrap">
                                    {{ $orderCustomer->customer->created_at }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </section>
        <aside class="flex flex-col h-full col-span-3 gap-3 pt-6 overflow-hidden rounded-lg bg-primary-color-admin">
            <div class="px-6 head-aside">
                <p class="text-2xl font-semibold">Top Product - This Week</p>
            </div>
            <div class="p-6 card-content flex flex-col gap-3 h-[36rem] overflow-y-auto">
                @forelse ($topProducts as $index => $product)
                    <div class="flex items-center w-full gap-6 card-topProduct">
                        <p class="text-lg w-[10%]">#{{ $index + 1 }}</p>
                        <img src="{{ asset('storage/' . $product->menu->image ?? asset('default-image.jpg')) }}"
                            class="object-cover w-[40%] h-28 rounded-lg" alt="{{ $product->menu->name }}" />
                        <div class="wrap w-[50%]">
                            <p class="text-lg line-clamp-1">{{ $product->menu->name }}</p>
                            <p class="text-base">{{ $product->menu->menu_type }}</p>
                        </div>
                    </div>
                @empty
                    <p class="my-auto text-lg font-semibold text-center text-red-500">
                        No Top Products Available for This Week! <br>
                        <span class="text-sm text-gray-400">Please check back later for updates.</span>
                    </p>
                @endforelse
            </div>
        </aside>

    </main>
</body>
<script src="{{ asset('/js/table.js') }}"></script>
<script src="{{ asset('/js/selectedStatus.js') }}"></script>

{{-- <script src="{{ asset('/js/tabs-sideMenu.js') }}"></script>
<script src="{{ asset('/js/imgPicker.js') }}"></script>
<script src="{{ asset('/js/tabs-menu.js') }}"></script>
<script src="{{ asset('/js/modal.js') }}"></script>
<script src="{{ asset('/js/pagginationPage.js') }}"></script> --}}

</html>
