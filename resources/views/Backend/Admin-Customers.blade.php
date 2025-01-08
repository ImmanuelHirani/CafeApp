<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
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
        <section class="flex flex-col h-full col-span-5 p-6 rounded-lg gap-9 bg-primary-color-admin">
            <div class="overflow-x-auto">
                <table id="tableCustomers" class="border shadow-sm min-w-fullborder stripe">
                    <thead class="">
                        <tr>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                ID
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Customers Username
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Email
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Status
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
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="text-base text-gray-900">{{ $user->user_ID }}</td>
                                <td class="text-base text-gray-500">
                                    {{ $user->username ?? 'Not Set Username Yet' }}
                                </td>
                                <td class="text-base text-gray-500">{{ $user->email }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <form action="{{ route('customer.updateStatus', $user->user_ID) }}" method="POST">
                                        @csrf
                                        <div class="status-select">
                                            <select name="is_active" id="statusSelect"
                                                class="cursor-pointer focus:outline-none" onchange="this.form.submit()">
                                                <hr>
                                                <optgroup label="Status Currently">
                                                    @if ($user->is_active == '1')
                                                        <option class="cursor-pointer">
                                                            Active
                                                        </option>
                                                    @else
                                                        <option class="cursor-pointer">
                                                            Non-Active
                                                        </option>
                                                    @endif
                                                </optgroup>
                                                <hr>
                                                <option value="1" class="cursor-pointer">
                                                    Active
                                                </option>
                                                <option value="0" class="cursor-pointer">
                                                    Non-Active
                                                </option>
                                            </select>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-base text-gray-500">{{ $user->created_at }}</td>
                                <td class="flex justify-center text-base text-gray-500">
                                    <div
                                        class="flex items-center cursor-pointer justify-center !text-white bg-blue-300 rounded-full w-9 h-9 btn">
                                        <a href="/customer/detail/{{ $user->user_ID ?? '' }}" class="text-xl">
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
            <div
                class="flex flex-col gap-3 px-6 pb-6 my-auto overflow-y-auto text-lg card-content h-fit sideMenu-tabs-content">
                @isset($userDetails)
                    <label for="" class="flex flex-col gap-3">
                        Customer Name
                        <input type="text" value="{{ $userDetails->username ?? 'Not Set Username Yet' }}"
                            class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin" placeholder="Max 20 Char" />
                    </label>
                    <label for="" class="flex flex-col gap-3">
                        Phone Number
                        <input type="number" value="{{ $userDetails->phone ?? '' }}"
                            class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin" placeholder="Max 20 Char" />
                    </label>
                    <label for="" class="flex flex-col gap-3">
                        Email
                        <input type="email" value="{{ $userDetails->email ?? '' }}"
                            class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin" placeholder="Max 20 Char" />
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
            <div class="flex flex-col gap-3 px-6 pb-6 my-auto overflow-y-auto card-content h-fit sideMenu-tabs-content">
                @isset($userDetails)
                    @php $i = 1; @endphp
                    @foreach ($userDetails->locationuser as $location)
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
                @else
                    <p class="text-lg font-semibold text-center text-red-500 ">
                        No Location Details Available! <br>
                        <span class="text-sm text-gray-400">Please ensure customer details are properly select.</span>
                    </p>
                @endisset
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
