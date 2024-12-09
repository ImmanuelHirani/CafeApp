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
    @vite('resources/css/app.css')
</head>

<body id="Admin">
    @include('layout.header')
    <main class="grid grid-cols-7 gap-4 py-4">
        <section class="flex flex-col col-span-5 p-6 rounded-lg gap-9 bg-primary-color-admin">
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
                                Type
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
                        <tr class="hover:bg-gray-50">
                            <td class="text-base text-gray-900">#CUS1R</td>
                            <td class="text-base text-gray-500">
                                Immanuel Christian Hirani
                            </td>
                            <td class="text-base text-gray-500">nuel.hirani8@gmail.com</td>
                            <td class="">
                                <div class="status-select">
                                    <select id="statusSelect" class="cursor-pointer focus:outline-none">
                                        <option value="completed" class="cursor-pointer">
                                            Reguler
                                        </option>
                                        <option value="in-progress" class="cursor-pointer">
                                            Member
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td class="text-base text-gray-500">12 sep 2023 , 18,32</td>
                            <td class="flex justify-center text-base text-gray-500">
                                <div
                                    class="flex items-center cursor-pointer justify-center !text-white bg-blue-300 rounded-full w-9 h-9 btn">
                                    <a class="text-xl"><i class="ti ti-eye-search"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <aside class="flex flex-col col-span-2 gap-8 pt-6 overflow-hidden rounded-lg bg-primary-color-admin">
            <div class="px-6 head-aside">
                <p class="text-xl font-semibold">Custom Order Details</p>
            </div>
            <div class="px-6 quick-link">
                <ul class="flex items-center justify-between w-full gap-3 text-base">
                    <li
                        class="relative w-full px-4 py-2 text-center transition-all duration-300 ease-in-out rounded-full cursor-pointer group outline-1 sideMenu-tabs-toggle">
                        <a class="!text-accent-color-admin">Customer Details</a>
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
                        <label for="" class="flex flex-col gap-3">
                            Customer Name
                            <input type="text" class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                placeholder="Max 20 Char" />
                        </label>
                        <label for="" class="flex flex-col gap-3">
                            Phone Number
                            <input type="number" class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                placeholder="Max 20 Char" />
                        </label>
                        <label for="" class="flex flex-col gap-3">
                            Email
                            <input type="email" class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                placeholder="Max 20 Char" />
                        </label>
                        <label for="" class="flex flex-col gap-3">
                            Location Detail Order
                            <textarea name="" rows="4" class="p-3 rounded-lg outline-none resize-none bg-secondary-color-admin"
                                placeholder="Max 150 Char"></textarea>
                        </label>
                    </div>
                </div>
            </form>
            <form action="" class="sideMenu-tabs-content">
                <div class="flex flex-col gap-3 px-6 pb-6 overflow-y-auto card-wrapper">
                    <div class="flex flex-col gap-3 text-lg order-card">
                        <img src="../asset/Logo/Pizza Menu/Blackpaper.jpg" class="object-cover w-full rounded-lg h-28"
                            alt="" />
                        <div class="flex flex-col gap-2 topping-list">
                            <p class="font-semibold">Topping List :</p>
                            <div class="flex flex-wrap items-center gap-2 list-wrap">
                                <button
                                    class="px-4 py-2 text-base rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                    Nuttela
                                </button>
                                <button
                                    class="px-4 py-2 text-base rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                    Nuttela
                                </button>
                                <button
                                    class="px-4 py-2 text-base rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                    Nuttela
                                </button>

                                <button
                                    class="px-4 py-2 text-base rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                    Nuttela
                                </button>
                                <button
                                    class="px-4 py-2 text-base rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                    Nuttela
                                </button>
                                <button
                                    class="px-4 py-2 text-base rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                    Nuttela
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 tiny-details">
                            <p class="!text-gray-500">Quantity : 1</p>
                            <p class="!text-gray-500">Size : XXL</p>
                        </div>
                        <p class="font-semibold">Total : Rp 60.000</p>
                    </div>
                    <hr />
                    <div class="flex flex-col gap-3 text-lg order-card">
                        <img src="../asset/Logo/Pizza Menu/Blackpaper.jpg" class="object-cover w-full rounded-lg h-28"
                            alt="" />
                        <div class="flex flex-col gap-2 topping-list">
                            <p class="font-semibold">Topping List :</p>
                            <div class="flex flex-wrap items-center gap-2 list-wrap">
                                <button
                                    class="px-4 py-2 text-base rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                    Nuttela
                                </button>
                                <button
                                    class="px-4 py-2 text-base rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                    Nuttela
                                </button>
                                <button
                                    class="px-4 py-2 text-base rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                    Nuttela
                                </button>

                                <button
                                    class="px-4 py-2 text-base rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                    Nuttela
                                </button>
                                <button
                                    class="px-4 py-2 text-base rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                    Nuttela
                                </button>
                                <button
                                    class="px-4 py-2 text-base rounded-full bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                    Nuttela
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 tiny-details">
                            <p class="!text-gray-500">Quantity : 1</p>
                            <p class="!text-gray-500">Size : XXL</p>
                        </div>
                        <p class="font-semibold">Total : Rp 60.000</p>
                    </div>
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
