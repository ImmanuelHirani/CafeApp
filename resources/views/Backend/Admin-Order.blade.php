<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <!-- jQuery dan DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    @vite('resources/css/app.css')
</head>

<body id="Admin">
    @include('layout.header')
    <main class="grid grid-cols-7 gap-4 py-4">
        <section class="flex flex-col col-span-5 p-6 rounded-lg h-fit gap-9 bg-primary-color-admin">
            <div class="overflow-x-auto">
                <table id="tableCustomers" class="min-w-full font-semibold border shadow-sm stripe">
                    <thead class="">
                        <tr>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                ID
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Customers Name
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Payment Ammount
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Status
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Purchase Date
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($orderCustomers as $orderCustomer)
                            <tr class="hover:bg-gray-50">
                                <td class="text-base text-gray-900">{{ $orderCustomer->order_ID }}</td>
                                <td class="text-base text-gray-500">
                                    {{ $orderCustomer->customer->username ?? 'Not Set The Username Yet' }}
                                </td>
                                <td class="text-base text-center text-secondary-accent-color">
                                    Rp {{ number_format($orderCustomer->total_amounts, 0, ',', '.') }}
                                </td>
                                <td class="">
                                    <form action="{{ route('order.updateStatus', $orderCustomer->order_ID) }}"
                                        method="POST">
                                        @csrf
                                        <div class="status-select">
                                            <select name="status_order" id="statusSelect"
                                                class="cursor-pointer focus:outline-none" onchange="this.form.submit()">
                                                <hr>
                                                <optgroup label="Status Currently">
                                                    <option value="{{ $orderCustomer->status_order }}"
                                                        class="cursor-pointer">
                                                        {{ $orderCustomer->status_order }}
                                                    </option>
                                                </optgroup>
                                                <hr>
                                                <option value="pending" class="cursor-pointer">
                                                    pending
                                                </option>
                                                <option value="in-progress" class="cursor-pointer">
                                                    in-progress
                                                </option>
                                                <option value="paid" class="cursor-pointer">
                                                    paid
                                                </option>
                                                <option value="serve" class="cursor-pointer">
                                                    serve
                                                </option>
                                                <option value="shipped" class="cursor-pointer">
                                                    shipped
                                                </option>
                                                <option value="completed" class="cursor-pointer">
                                                    completed
                                                </option>
                                                <option value="canceled" class="cursor-pointer">
                                                    canceled
                                                </option>
                                            </select>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-base text-gray-500"> {{ $orderCustomer->customer->created_at }}</td>
                                <td class="flex justify-center text-base text-gray-500">
                                    <div
                                        class="flex items-center cursor-pointer justify-center !text-white bg-blue-300 rounded-full w-9 h-9 btn">
                                        <a href="{{ route('admin.order.details', $orderCustomer->order_ID ?? '') }}"
                                            class="text-xl">
                                            <i class="ti ti-eye-search"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <aside class="flex flex-col col-span-2 gap-8 pt-6 overflow-hidden rounded-lg h-fit bg-primary-color-admin">
            <div class="px-6 head-aside">
                <p class="text-xl font-semibold">Order Details</p>
            </div>
            <div class="px-6 quick-link">
                <ul class="flex items-center justify-between w-full gap-3 text-base">
                    <li
                        class="relative w-full px-4 py-2 text-center transition-all duration-300 ease-in-out rounded-full cursor-pointer group outline-1 sideMenu-tabs-toggle">
                        <a class="!text-accent-color-admin">Reciver Details</a>
                    </li>
                    <li
                        class="relative w-full px-4 py-2 text-center transition-all duration-300 ease-in-out rounded-full cursor-pointer sideMenu-tabs-toggle group outline-1">
                        <a class="!text-accent-color-admin">Order Details</a>
                    </li>
                </ul>
            </div>
            <form action="" class="sideMenu-tabs-content">
                <div class="px-6 pb-6 overflow-y-auto card-content">
                    <div class="flex flex-col gap-3 text-lg">
                        @isset($orderDetails)
                            <label for="" class="flex flex-col gap-3">
                                Reciver Name
                                <input type="text"
                                    value="{{ $orderDetails->location->first()->reciver_name ?? 'Not Set The Username Yet' }}"
                                    class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                    placeholder="Max 20 Char" />
                            </label>
                            <label for="" class="flex flex-col gap-3">
                                Phone Number
                                <input type="text"
                                    value="{{ $orderDetails->location->first()->reciver_number ?? 'Not Set The Phone Number Yet' }}"
                                    class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                    placeholder="Max 20 Char" />
                            </label>
                            <label for="" class="flex flex-col gap-3">
                                Location Reciver Detail
                                <textarea name="" rows="4" class="p-3 rounded-lg outline-none resize-none bg-secondary-color-admin"
                                    placeholder="Max 150 Char">{{ $orderDetails->location->first()->reciver_address ?? 'Not Set The Address Yet' }}</textarea>
                            </label>
                        @else
                            <label for="" class="flex flex-col gap-3">
                                Reciver Name
                                <input type="text" value="Select order detail first"
                                    class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                    placeholder="Max 20 Char" />
                            </label>
                            <label for="" class="flex flex-col gap-3">
                                Phone Number
                                <input type="text" value="Select order detail first"
                                    class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                    placeholder="Max 20 Char" />
                            </label>
                            <label for="" class="flex flex-col gap-3">
                                Location Reciver Detail
                                <textarea name="" rows="4" class="p-3 rounded-lg outline-none resize-none bg-secondary-color-admin"
                                    placeholder="Max 150 Char">Select order detail first</textarea>
                            </label>
                        @endisset
                    </div>
                </div>
            </form>
            <form action="" class="sideMenu-tabs-content">
                <div class="flex flex-col gap-3 px-6 pb-6 h-[28.5rem] overflow-y-auto card-wrapper">
                    @isset($orderDetails)
                        <div class="flex flex-col gap-3 text-lg order-card">
                            @forelse ($orderDetails->details as $detail)
                                @if ($detail)
                                    <!-- Check if order_type is custom_menu -->
                                    @if ($detail->order_type == 'custom_menu')
                                        <!-- Custom Order -->
                                        <img src="{{ asset('/asset/CustomOrder.png') }}"
                                            class="object-cover w-full outline outline-1 outline-secondary-accent-color rounded-3xl img-preview h-72"
                                            alt="Custom Order" />
                                        <div class="flex flex-wrap items-center gap-2 list-wrap">
                                            <label
                                                class="w-full px-4 py-2 text-base text-center rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                                Custom Order
                                            </label>
                                        </div>
                                        <!-- Topping (explode menu_name into array and show it in textarea) -->
                                        @php
                                            $toppings = explode(',', $detail->menu_name); // Exploding menu_name into an array
                                        @endphp
                                        <p>Toppings : </p>
                                        <div class="flex flex-wrap items-center w-full gap-2 wrap">
                                            @foreach ($toppings as $topping)
                                                <label
                                                    class="px-4 py-2 text-base text-center rounded-full w-fit bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                                    {{ $topping }}
                                                </label>
                                            @endforeach
                                        </div>
                                    @else
                                        <!-- Regular Menu Order -->
                                        <img src="{{ asset('storage/' . $detail->menu->image) }}"
                                            class="object-cover w-full outline outline-1 outline-secondary-accent-color rounded-3xl img-preview h-72"
                                            alt="{{ $detail->menu_name ?? 'Unknown Menu' }}" />
                                        <div class="flex flex-wrap items-center gap-2 list-wrap">
                                            <label
                                                class="w-full px-4 py-2 text-base text-center rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                                {{ $detail->menu_name ?? 'Unknown Menu' }}
                                            </label>
                                        </div>
                                    @endif
                                    <!-- Detail Transaksi -->
                                    <div class="flex items-center gap-6 tiny-details">
                                        <p class="!text-gray-500">Quantity: {{ $detail->quantity ?? 'unknown' }}</p>
                                        <p class="!text-gray-500">Size: {{ $detail->size ?? 'unknown' }}</p>
                                    </div>
                                    <!-- Total -->
                                    <p class="font-semibold">Total: Rp
                                        {{ number_format($detail->subtotal ?? 0, 0, ',', '.') }}</p>
                                    <hr />
                                @endif
                            @empty
                                <p class="text-gray-500">No Toppings Found</p>
                            @endforelse
                        </div>
                    @else
                        <div class="flex flex-col gap-3 text-lg order-card">
                            <img src="" class="object-cover w-full rounded-lg h-[15rem]" alt="No Image Available"
                                onerror="this.onerror=null; this.src='{{ asset('asset/Error-Image.png') }}';" />
                            <div class="flex flex-wrap items-center gap-2 list-wrap">
                                <label
                                    class="px-4 py-2 text-base rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                    No Menu found
                                </label>
                            </div>
                            <div class="flex items-center gap-6 tiny-details">
                                <p class="!text-gray-500">Quantity: Unknown</p>
                                <p class="!text-gray-500">Size: Unknown</p>
                            </div>
                            <p class="font-semibold">Total: Rp 0</p>
                            <hr />
                        </div>
                    @endisset
                </div>
            </form>
            <div class="flex items-center w-full gap-3 p-4 mt-auto bg-white shadow-inner h-fit footer-toggle">
                <button type="submit"
                    class="w-full h-12 rounded-full text-secondary-accent-color bg-secondary-accent-color-admin outline outline-gray-200 outline-[1px]">
                    Cancle Order
                </button>
                <button type="submit" class="w-full h-12 !text-white rounded-full bg-secondary-accent-color">
                    Finish Order
                </button>
            </div>
        </aside>
    </main>
</body>
<script src="{{ asset('/js/table.js') }}"></script>
<script src="{{ asset('/js/selectedStatus.js') }}"></script>
<script src="{{ asset('/js/tabs-sideMenu.js') }}"></script>

</html>
