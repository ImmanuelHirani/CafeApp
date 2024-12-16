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
    <main class="grid grid-cols-10 gap-3 py-4">
        <section class="flex flex-col col-span-7 p-6 rounded-lg gap-9 bg-primary-color-admin">
            <div class="flex items-center justify-between wrap">
                <p class="text-2xl font-semibold">Custom Pizza</p>
                <button id="btn-add-product"
                    class="flex items-center group hover:bg-secondary-accent-color transition-all ease-in-out duration-300 hover:!text-white w-fit gap-3 px-4 justify-center py-3 h-10 outline outline-2 outline-accent-color-admin rounded-full !text-accent-color-admin">
                    New Categories
                    <i class="ti ti-plus group-hover:!text-white !text-accent-color-admin text-xl"></i>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table id="tableCustomers" class="border shadow-sm min-w-fullborder stripe">
                    <thead class="">
                        <tr>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                ID
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Categories Type
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                status
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Created At
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Updated At
                            </th>
                            <th class="text-sm font-medium text-left text-gray-500 uppercase">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="text-base text-gray-900">{{ $category->categories_ID }}</td>
                                <td class="text-base text-gray-500">{{ $category->categories_type }}</td>
                                @if ($category->is_active == 1)
                                    <td class="text-base text-gray-500"><label
                                            class="px-8 py-3 text-white bg-green-500 rounded-full shadow-lg">Active</label>
                                    </td>
                                @else
                                    <td class="text-base text-gray-500"><label
                                            class="px-8 py-3 text-white bg-red-500 rounded-full shadow-lg">Non-Active</label>
                                    </td>
                                @endif
                                <td class="text-base text-gray-500">{{ $category->created_at }}</td>
                                <td class="text-base text-gray-500">{{ $category->updated_at }}</td>
                                <td class="flex justify-center gap-1 text-base text-gray-500">
                                    <div
                                        class="flex items-center cursor-pointer justify-center !text-white bg-blue-500 rounded-full w-9 h-9 btn">
                                        <a href="{{ route('custom.categories.details', $category->categories_ID ?? '') }}"
                                            class="text-xl cursor-pointer">
                                            <i class="ti ti-eye-search"></i>
                                        </a>
                                    </div>
                                    <div
                                        class="flex items-center cursor-pointer justify-center !text-white bg-red-500 rounded-full w-9 h-9 btn">
                                        <form
                                            action="{{ Route('custom.categories.delete', $category->categories_ID ?? '') }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-xl cursor-pointer">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <aside class="flex flex-col col-span-3 gap-8 pt-6 overflow-hidden rounded-lg bg-primary-color-admin">
            <div class="px-6 head-aside">
                <p class="text-xl font-semibold">Edit Custom Menu</p>
            </div>
            <div class="px-6 quick-link">
                <ul class="flex items-center justify-between w-full gap-3 text-base">
                    <li
                        class="relative w-full px-4 py-2 text-center transition-all duration-300 ease-in-out rounded-full cursor-pointer group outline-1 sideMenu-tabs-toggle">
                        <a class="!text-accent-color-admin">Categories Details</a>
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
            <div class="flex items-center w-full gap-3 p-4 mt-auto bg-white shadow-inner h-fit footer-toggle">
                <button type="submit" class="w-full h-12 !text-white rounded-lg bg-secondary-accent-color">
                    Update
                </button>
            </div>
        </aside>
        @include('layout.modal.modal-custom-menu')
    </main>
</body>
<script src="{{ asset('/js/table.js') }}"></script>
<script src="{{ asset('/js/modal.js') }}"></script>
<script src="{{ asset('/js/selectedStatus.js') }}"></script>
<script src="{{ asset('/js/tabs-sideMenu.js') }}"></script>

</html>
