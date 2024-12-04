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
    <main class="grid grid-cols-8 gap-4 py-4">
        <section class="flex flex-col col-span-6 p-6 rounded-lg gap-9 bg-primary-color-admin">
            <div class="overflow-x-auto">
                <table id="orderTable" class="border shadow-sm min-w-fullborder stripe">
                    <thead class="">
                        <tr>
                            <th class="px-6 py-3 text-sm font-medium text-left text-gray-500 uppercase">
                                Order ID
                            </th>
                            <th class="px-6 py-3 text-sm font-medium text-left text-gray-500 uppercase">
                                Customers
                            </th>
                            <th class="px-6 py-3 text-sm font-medium text-left text-gray-500 uppercase">
                                Payment Amount
                            </th>
                            <th class="px-6 py-3 text-sm font-medium text-left text-gray-500 uppercase">
                                Status
                            </th>
                            <th class="px-6 py-3 text-sm font-medium text-left text-gray-500 uppercase">
                                Purchase Date
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php for ($i = 0; $i < 20; $i++) : ?>
                        <tr class="hover:bg-gray-50">
                            <td class="text-base text-gray-900 whitespace-nowrap">
                                #812381
                            </td>
                            <td class="text-base text-gray-500 whitespace-nowrap">
                                Immanuel Christian ...
                            </td>
                            <td class="text-base text-gray-500 whitespace-nowrap">
                                Rp.350.000
                            </td>
                            <td class="">
                                <div class="status-select">
                                    <select id="statusSelect" class="cursor-pointer focus:outline-none">
                                        <option value="completed" class="cursor-pointer">
                                            Completed
                                        </option>
                                        <option value="in-progress" class="cursor-pointer">
                                            In Progress
                                        </option>
                                        <option value="canceled" class="cursor-pointer">
                                            Canceled
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td class="text-base text-gray-500 whitespace-nowrap">
                                12 sep 2023 , 18,32
                            </td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <aside class="flex flex-col col-span-2 gap-3 pt-6 overflow-hidden rounded-lg bg-primary-color-admin">
            <div class="px-6 head-aside">
                <p class="text-2xl font-semibold">Top Product - This Week</p>
            </div>
            <div class="p-6 card-content flex flex-col gap-3 h-[36rem] overflow-y-auto">
                <?php for($i = 0 ; $i < 10; $i++) : ?>
                <div class="flex items-center gap-6 card-topProduct">
                    <p class="text-lg">#<?= $i + 1 ?></p>
                    <img src="../asset/Logo/Pizza Menu/Newyork Pizza.jpg" class="object-cover w-40 h-20 rounded-lg"
                        alt="" />
                    <div class="wrap">
                        <p class="text-lg line-clamp-1">Pizza Manuela Creamy Juicy</p>
                        <p class="text-base">Bubble Ice</p>
                    </div>
                </div>
                <?php endfor; ?>
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
