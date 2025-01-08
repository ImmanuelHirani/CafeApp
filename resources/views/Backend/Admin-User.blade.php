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
        <section class="flex flex-col h-full col-span-7 p-6 rounded-lg gap-9 bg-primary-color-admin">
            <div class="overflow-x-auto">
                <table id="tableCustomers" class="border shadow-sm min-w-fullborder stripe">
                    <thead class="">
                        <tr>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                ID
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Admin Username
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Role
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
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($admins as $admin)
                            <tr class="hover:bg-gray-50">
                                <td class="text-base text-gray-900">{{ $admin->user_ID }}</td>
                                <td class="text-base text-gray-500">
                                    {{ $admin->username ?? 'Not Set Username Yet' }}
                                </td>
                                <td class="text-base text-gray-500">
                                    {{ $admin->user_type ?? 'Not Set Username Yet' }}
                                </td>
                                <td class="text-base text-gray-500">{{ $admin->email }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <form action="{{ route('customer.updateStatus', $admin->user_ID) }}" method="POST">
                                        @csrf
                                        <div class="status-select">
                                            <select name="is_active" id="statusSelect"
                                                class="cursor-pointer focus:outline-none" onchange="this.form.submit()">
                                                <hr>
                                                <optgroup label="Status Currently">
                                                    @if ($admin->is_active == '1')
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
                                <td class="text-base text-gray-500">{{ $admin->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
<script src="{{ asset('/js/table.js') }}"></script>
<script src="{{ asset('/js/selectedStatus.js') }}"></script>
<script src="{{ asset('/js/tabs-menu.js') }}"></script>
<script src="{{ asset('/js/pagginationPage.js') }}"></script>
<script src="{{ asset('/js/tabs-sideMenu.js') }}"></script>

</html>
