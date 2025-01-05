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
        <section class="flex flex-col col-span-7 p-6 rounded-lg h-fit gap-9 bg-primary-color-admin">
            <div class="overflow-x-auto">
                <table id="tableCS" class="min-w-full border shadow-sm stripe">
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
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Messages
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                created_at
                            </th>

                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($CSMessages as $CSMessage)
                            <tr class="hover:bg-gray-50">
                                <td class="text-base text-gray-900">{{ $CSMessage->customer_ID }}</td>
                                <td class="text-base text-gray-500">
                                    {{ $CSMessage->name }}
                                </td>
                                <td class="text-base text-gray-500">{{ $CSMessage->email }}</td>
                                <td class="text-base text-gray-500">{{ $CSMessage->messages }}</td>
                                <td class="text-base text-gray-500">{{ $CSMessage->created_at }}</td>
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
