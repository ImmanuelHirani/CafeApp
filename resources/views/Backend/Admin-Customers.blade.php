<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../public/output.css" rel="stylesheet" />
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
    @vite('resources/css/app.css')
</head>

<body id="Admin">
    @include('layout.header')
    <main class="grid grid-cols-7 gap-4 py-4">
        <section class="flex flex-col h-full col-span-5 p-6 rounded-lg gap-9 bg-primary-color-admin">
            <div class="overflow-x-auto">
                <table id="tableCustomers" class="border shadow-sm min-w-fullborder stripe">
                    <thead class="">
                        <tr>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                ID
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Customers Name
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Email
                            </th>



                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Join Date
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($customers as $customer)
                            <tr class="hover:bg-gray-50">
                                <td class="text-base text-gray-900">{{ $customer->customer_ID }}</td>
                                <td class="text-base text-gray-500">
                                    {{ $customer->username ?? 'Not Set Username Yet' }}
                                </td>
                                <td class="text-base text-gray-500">{{ $customer->email }}</td>

                                <td class="text-base text-gray-500">{{ $customer->created_at }}</td>
                                <td class="flex justify-center text-base text-gray-500">
                                    <div
                                        class="flex items-center cursor-pointer justify-center !text-white bg-blue-300 rounded-full w-9 h-9 btn">
                                        <a href="/customer/detail/{{ $customer->customer_ID ?? '' }}" class="text-xl">
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
        <aside class="flex flex-col h-full col-span-2 gap-8 pt-6 overflow-hidden rounded-lg bg-primary-color-admin">
            <div class="px-6 head-aside">
                <p class="text-xl font-semibold">Customers Details</p>
            </div>
            <div class="px-6 quick-link">
                <ul class="flex items-center justify-between w-full gap-3 text-base">
                    <li
                        class="relative w-full px-4 py-2 text-center transition-all duration-300 ease-in-out rounded-full cursor-pointer sideMenu-tabs-toggle group outline-1">
                        <a class="!text-accent-color-admin">Details</a>
                    </li>
                    <li
                        class="relative w-full px-4 py-2 text-center transition-all duration-300 ease-in-out rounded-full cursor-pointer group outline-1 sideMenu-tabs-toggle">
                        <a class="!text-accent-color-admin">Locations</a>
                    </li>
                </ul>
            </div>

            <div class="px-6 pb-6 overflow-y-auto card-content sideMenu-tabs-content">
                <div class="flex flex-col gap-3 text-lg">
                    @isset($customerDetails)
                        <label for="" class="flex flex-col gap-3">
                            Customer Name
                            <input type="text" value="{{ $customerDetails->username ?? 'Not Set Username Yet' }}"
                                class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                placeholder="Max 20 Char" />
                        </label>
                        <label for="" class="flex flex-col gap-3">
                            Phone Number
                            <input type="number" value="{{ $customerDetails->phone ?? '' }}"
                                class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                placeholder="Max 20 Char" />
                        </label>
                        <label for="" class="flex flex-col gap-3">
                            Email
                            <input type="email" value="{{ $customerDetails->email ?? '' }}"
                                class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                placeholder="Max 20 Char" />
                        </label>
                        {{-- <button type="submit" id="SendRequestEmail"
                                class="p-2 !text-gray-500 rounded-full outline outline-1 outline-gray-300 bg-secondary-color-admin">
                                Send Request Reset Password
                            </button> --}}
                    @else
                        <p class="text-lg font-semibold text-center text-red-500">
                            No Customer Details Available! <br>
                            <span class="text-sm text-gray-400">Please ensure customer details are properly
                                select.</span>
                        </p>
                    @endisset
                </div>
            </div>
            <div class="flex flex-col gap-3 px-6 pb-6 my-auto overflow-y-auto card-content h-fit sideMenu-tabs-content">
                @isset($customerDetails)
                    @if ($customerDetails->locationCustomer->isEmpty())
                        <p class="text-lg font-semibold text-center text-red-500">
                            No Locations Available! <br>
                            <span class="text-sm text-gray-400">Please add a location to your profile.</span>
                        </p>
                    @else
                        @php $i = 1; @endphp
                        @foreach ($customerDetails->locationCustomer as $location)
                            <div class="w-full py-2 text-center rounded-lg h-fit line bg-secondary-accent-color-admin">
                                Location {{ $i }}
                            </div>
                            <div class="flex flex-col gap-3 text-lg">
                                <label for="" class="flex flex-col gap-3">
                                    Reciver Name
                                    <input type="text" value="{{ $location->reciver_name }}"
                                        class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                        placeholder="Max 20 Char" />
                                </label>
                                <label for="" class="flex flex-col gap-3">
                                    Phone Number
                                    <input type="text" value="{{ $location->reciver_number }}"
                                        class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                        placeholder="Max 20 Char" />
                                </label>
                                <label for="" class="flex flex-col gap-3">
                                    Location Lable
                                    <input type="text" value="{{ $location->location_label }}"
                                        class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                        placeholder="Max 20 Char" />
                                </label>
                                <label for="" class="flex flex-col gap-3">
                                    Location Detail
                                    <textarea name="" rows="4" class="p-3 rounded-lg outline-none resize-none bg-secondary-color-admin"
                                        placeholder="Max 150 Char">{{ $location->reciver_address }}</textarea>
                                </label>
                            </div>
                            @php $i++; @endphp
                        @endforeach
                    @endif
                @else
                    <p class="text-lg font-semibold text-center text-red-500">
                        No Location Details Available! <br>
                        <span class="text-sm text-gray-400">Please ensure customer details are properly select.</span>
                    </p>
                @endisset
            </div>
            <input type="submit" id="update" value="Update" class="hidden">

            <div class="flex items-center w-full gap-3 p-4 mt-auto bg-white shadow-inner h-fit footer-toggle">
                <label for="update"
                    class="w-full h-12 text-center cursor-pointer items-center justify-center flex !text-white rounded-full bg-secondary-accent-color">
                    Non-Active A Customer
                </label>
            </div>
        </aside>
    </main>
</body>

<script src="{{ asset('/js/table.js') }}"></script>
<script src="{{ asset('/js/selectedStatus.js') }}"></script>
<script src="{{ asset('/js/tabs-menu.js') }}"></script>
<script src="{{ asset('/js/pagginationPage.js') }}"></script>
<script src="{{ asset('/js/tabs-sideMenu.js') }}"></script>

</html>
