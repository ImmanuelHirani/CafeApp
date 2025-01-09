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
    <main class="grid grid-cols-7 gap-3 py-4">
        <section class="flex flex-col h-full col-span-5 p-6 rounded-lg gap-9 bg-primary-color-admin">
            <div class="flex items-center justify-between wrap">
                <p class="text-2xl font-medium">Custom Pizza</p>
                <button id="btn-add-product"
                    class="flex items-center group hover:bg-secondary-accent-color transition-all ease-in-out duration-300 hover:!text-white w-fit gap-3 px-4 justify-center py-3 h-10 outline outline-2 outline-accent-color-admin rounded-full !text-accent-color-admin">
                    New Categories
                    <i class="ti ti-plus group-hover:!text-white !text-accent-color-admin text-xl"></i>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table id="table_custom_pizza" class="border shadow-sm min-w-fullborder stripe">
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
                                <td>
                                    <form action="{{ route('custom.updateStatus', $category->categories_ID) }}"
                                        method="POST">
                                        @csrf
                                        <div class="status-select">
                                            <select name="is_active" id="statusSelect"
                                                class="cursor-pointer focus:outline-none" onchange="this.form.submit()">
                                                <hr>
                                                <optgroup label="Status Currently">
                                                    @if ($category->is_active == '1')
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
                                        <form onclick="confirmation(event)"
                                            action="{{ Route('custom.categories.delete', $category->categories_ID ?? '') }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button id="trash" type="submit" class="text-xl cursor-pointer">
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
        <aside class="flex flex-col h-full col-span-2 gap-8 pt-6 overflow-hidden rounded-lg bg-primary-color-admin">
            <div class="px-6 head-aside">
                <p class="text-xl font-medium">Edit Custom Menu</p>
            </div>
            <div class="px-6 quick-link">
                <ul class="flex items-center justify-between w-full gap-3 text-base">
                    <li
                        class="relative w-full px-4 py-2 text-center transition-all duration-300 ease-in-out rounded-full cursor-pointer group outline-1 sideMenu-tabs-toggle">
                        <a class="!text-accent-color-admin">Properties</a>
                    </li>
                    <li
                        class="relative w-full px-4 py-2 text-center transition-all duration-300 ease-in-out rounded-full cursor-pointer group outline-1 sideMenu-tabs-toggle">
                        <a class="!text-accent-color-admin">Size & Pricing</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('update.properties') }}" class="flex flex-col h-full" method="POST">
                @csrf
                <div class="flex flex-col gap-3 px-6 py-1 pb-6 overflow-y-auto card-wrapper sideMenu-tabs-content">
                    {{-- Topping List Section --}}
                    <div class="flex flex-col gap-3 text-lg order-card">
                        <div class="flex flex-col gap-3 topping-list">
                            <div class="flex items-center justify-between gap-3 mb-4 wrap">
                                <p class="font-medium">Topping List :</p>
                                <label id="btn-add-properties"
                                    class="cursor-pointer btn-add-product flex items-center group hover:bg-secondary-accent-color transition-all ease-in-out duration-300 hover:!text-white w-fit gap-3 px-4 justify-center text-base py-2 outline outline-2 outline-accent-color-admin rounded-full !text-accent-color-admin">
                                    New Properties
                                </label>
                            </div>
                            <div class="flex flex-wrap items-center justify-center gap-2 list-wrap">
                                @isset($detailCategories)
                                    @foreach ($detailCategories->properties as $detail)
                                        <input type="text" name="properties[{{ $detail->properties_ID }}][name]"
                                            value="{{ $detail->properties_name }}"
                                            class="w-full px-4 py-2 text-base rounded-lg bg-secondary-accent-color-admin outline outline-1 outline-gray-300">
                                        <div class="flex items-center w-full gap-3 wrap">
                                            <input type="number" name="properties[{{ $detail->properties_ID }}][price]"
                                                class="w-full p-2 rounded-lg outline-none bg-secondary-color-admin size-price"
                                                min="0" value="{{ $detail->price }}" />
                                            <select name="properties[{{ $detail->properties_ID }}][is_active]"
                                                class="relative w-full p-3 rounded-lg outline-none {{ $detail->is_active == 1 ? 'bg-green-500 text-white' : 'bg-secondary-color text-white' }}">
                                                <option value="1" class="font-medium"
                                                    {{ ($detail->is_active ?? '') == 1 ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="0" class="font-medium"
                                                    {{ ($detail->is_active ?? '') == 0 ? 'selected' : '' }}>
                                                    Non-Active
                                                </option>
                                            </select>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-lg font-medium text-center text-red-500">
                                        No properties Details Available! <br>
                                        <span class="text-sm text-gray-400">Please ensure Categories details are properly
                                            select.</span>
                                    </p>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Size Section --}}
                <div class="px-6 pb-6 space-y-2 sideMenu-tabs-content h-fit">
                    <div class="flex items-center justify-between gap-3 wrap">
                        <p class="font-medium">Size List :</p>
                        @isset($sizes)
                            @php
                                $isSizesAvailable = $sizes->isNotEmpty();
                            @endphp
                            @if (!$isSizesAvailable)
                                <label id="btn-add-size"
                                    class="cursor-pointer btn-add-product flex items-center group hover:bg-secondary-accent-color transition-all ease-in-out duration-300 hover:!text-white w-fit gap-3 px-4 justify-center text-base py-2 outline outline-2 outline-accent-color-admin rounded-full !text-accent-color-admin">
                                    Create Size Rules
                                </label>
                            @endif
                        @endisset
                    </div>
                    @isset($sizes)
                        @foreach ($sizes as $size)
                            <div class="flex items-center gap-3 wrap">
                                <input type="text" name="sizeProperties[{{ $size->size_ID }}][size]"
                                    value="{{ $size->size }}" placeholder="Size"
                                    class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] h-[3rem]">
                                <input type="number" name="sizeProperties[{{ $size->size_ID }}][price]"
                                    class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin size-price"
                                    min="0" value="{{ $size->price }}" />
                                <p>Allowed Flavor:</p>
                                <input type="text" name="sizeProperties[{{ $size->size_ID }}][allowed_flavor]"
                                    value="{{ $size->allowed_flavor }}"
                                    class="p-2 uppercase border-2 rounded-lg text-center text-secondary-accent-color border-secondary-accent-color w-[3.5rem] h-[3rem]">
                            </div>
                        @endforeach
                    @else
                        <p class="text-lg font-medium text-center text-red-500">
                            No sizes Details Available! <br>
                            <span class="text-sm text-gray-400">Please ensure Categories details are properly
                                select.</span>
                        </p>

                    @endisset
                </div>

                {{-- Footer --}}
                <div class="flex items-center w-full gap-3 p-4 mt-auto bg-white shadow-inner footer-toggle">
                    <button type="submit" class="w-full h-12 text-white rounded-lg bg-secondary-accent-color">
                        Update
                    </button>
                </div>
            </form>
        </aside>
        @include('layout.modal.custom-menu.categories')
        @include('layout.modal.custom-menu.properties')
        @include('layout.modal.custom-menu.size')
    </main>
</body>
<script src="{{ asset('/js/table.js') }}"></script>
<script src="{{ asset('/js/modal.js') }}"></script>
<script src="{{ asset('/js/selectedStatus.js') }}"></script>
<script src="{{ asset('/js/tabs-sideMenu.js') }}"></script>
<script>
    function confirmation(ev) {
        ev.preventDefault(); // Mencegah pengiriman form default
        ev.stopPropagation(); // Mencegah event bubbling ke parent (div)

        const form = ev.currentTarget; // Mengambil elemen form yang memicu event
        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, kirim form
                form.submit();
            }
        });
    }
</script>

</html>
