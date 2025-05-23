<aside id="showSelectedMenu"
    class="flex flex-col h-full col-span-2 gap-8 pt-6 overflow-hidden rounded-lg bg-primary-color-admin">
    <div class="px-6 head-aside">
        <p class="text-xl font-medium">Edit Menu</p>
    </div>
    <div class="px-6 quick-link">
        <ul class="flex items-center justify-between w-full gap-3 text-base">
            <li
                class="relative w-full px-3.5 py-2 text-center transition-all duration-300 ease-in-out rounded-full cursor-pointer group outline-1 sideMenu-tabs-toggle">
                <a class="!text-accent-color-admin">Menu Detail</a>
            </li>
            <li
                class="relative w-full px-3.5 py-2 text-center transition-all duration-300 ease-in-out rounded-full cursor-pointer group outline-1 sideMenu-tabs-toggle">
                <a class="!text-accent-color-admin">Inventory & Pricing </a>
            </li>
        </ul>
    </div>
    <div class=" wrap">
        @php
            // Tentukan ID submit berdasarkan nama route
            $submitId = Route::currentRouteName() === 'menu-properties.update' ? 'update_properties' : 'update_menu';
        @endphp
        @isset($menuDetails)
            <form action="{{ route('update.menu', $menuDetails->menu_ID ?? '') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="px-6 pb-6 overflow-y-auto card-content sideMenu-tabs-content">
                    <div class="flex flex-col gap-3 text-lg">
                        <!-- Gambar Produk -->
                        <div class="relative overflow-hidden img-file-management">
                            <img src="{{ asset('storage/' . ($menuDetails->image ?? '')) }}"
                                class="{{ $menuDetails->image ?? '' ? 'object-cover' : 'object-cover' }} w-full rounded-3xl img-preview h-72"
                                alt="{{ $menuDetails->name ?? 'Default Image' }}"
                                onerror="this.onerror=null; this.src='{{ asset('asset/Error-Image.png') }}';" />
                            <input type="file" id="imgUpload" name="image" class="hidden file-img-product" />
                            <label for="imgUpload"
                                class="absolute px-8 text-base py-1.5 font-medium translate-x-1/2 bg-white rounded-full cursor-pointer outline-1 bottom-5 w-fit right-1/2">
                                Choose File
                            </label>
                        </div>
                        <p class="hidden mt-2 error-message font-medium text-center !text-red-500">
                            File harus berupa gambar (jpg, jpeg, png).
                        </p>
                        <!-- Nama Produk -->
                        <label for="menu_name" class="flex flex-col gap-3">
                            Product Name
                            <input type="text" name="name" value="{{ $menuDetails->name ?? '' }}"
                                class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                placeholder="Max 20 Char" />
                        </label>
                        <!-- Deskripsi -->
                        <label for="menu_description" class="flex flex-col gap-3">
                            Description
                            <textarea name="menu_description" rows="4"
                                class="p-3 rounded-lg outline-none resize-none bg-secondary-color-admin"
                                placeholder="Max 255 Char (only letters and spaces)">{{ $menuDetails->menu_description ?? '' }}</textarea>
                        </label>
                        <!-- Kategori -->
                        <label for="menu_type">Menu Categories</label>
                        <select name="menu_type" class="relative p-3 rounded-lg outline-none bg-secondary-color-admin">
                            <option value="pizza" {{ ($menuDetails->menu_type ?? '') == 'pizza' ? 'selected' : '' }}>Pizza
                            </option>
                            <option value="coffee" {{ ($menuDetails->menu_type ?? '') == 'coffee' ? 'selected' : '' }}>
                                Coffee</option>
                            <option value="bobba" {{ ($menuDetails->menu_type ?? '') == 'bobba' ? 'selected' : '' }}>Bobba
                            </option>
                        </select>
                        <!-- Status -->
                        <label for="status">Status</label>
                        <select name="is_active"
                            class="relative p-3 rounded-lg outline-none text-white
                           {{ $menuDetails->is_active == 1 ? 'bg-green-500' : 'bg-secondary-color' }}">
                            <option class="bg-green-500" value="1"
                                {{ ($menuDetails->is_active ?? 0) == 1 ? 'selected' : '' }}>Active
                            </option>
                            <option class="bg-secondary-color" value="0"
                                {{ ($menuDetails->is_active ?? 0) == 0 ? 'selected' : '' }}>Non-Active
                            </option>
                        </select>
                    </div>
                </div>
                <div class="px-6 pb-6 overflow-y-auto card-content sideMenu-tabs-content ">
                    <div class="flex flex-col gap-3 text-lg">
                        <label for="stock" class="flex flex-col gap-3">
                            Stock
                            <input type="number" name="stock" value="{{ $menuDetails->stock ?? '' }}"
                                class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                                placeholder="Max 20 Char" />
                        </label>
                        <p>Size & Pricing</p>
                        <div class="flex flex-wrap w-full gap-3">
                            @isset($menuDetails)
                                @foreach ($menuDetails->properties as $property)
                                    <div class="flex items-center w-full gap-3 wrap">
                                        <label
                                            class="p-2 uppercase border-2 rounded-lg text-secondary-accent-color border-secondary-accent-color w-[3.5rem] flex items-center justify-center h-[3rem]">{{ $property->size }}</label>
                                        <input type="number"
                                            class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin size-price"
                                            min="0" name="properties[{{ $property->menu_size_ID }}][price]"
                                            value="{{ $property->price }}" />
                                        <select name="properties[{{ $property->menu_size_ID }}][is_active_properties]"
                                            class="relative w-full p-3 rounded-lg outline-none {{ $property->is_active_properties == 1 ? 'bg-green-500 text-white' : 'bg-secondary-color text-white' }}">
                                            <option value="1" class="font-medium"
                                                {{ ($property->is_active_properties ?? '') == 1 ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0" class="font-medium"
                                                {{ ($property->is_active_properties ?? '') == 0 ? 'selected' : '' }}>
                                                Non-Active
                                            </option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="properties[{{ $property->menu_size_ID }}][menu_size_ID]"
                                        value="{{ $property->menu_size_ID }}">
                                    <input type="hidden" name="properties[{{ $property->menu_size_ID }}][size]"
                                        value="{{ $property->size }}">
                                @endforeach
                            @else
                                <p>No sizes available for this menu.</p>
                            @endisset
                        </div>
                    </div>
                </div>
                <input type="submit" id="update_menu" value="Update" class="hidden">
                <input type="submit" id="update_properties" value="Update" class="hidden">
            </form>
        @else
            <div class="px-6 pb-6 overflow-y-auto card-content sideMenu-tabs-content">
                <div class="flex flex-col gap-3 text-lg">
                    <p class="text-lg font-medium text-center text-red-500">
                        No Menu Details was Found <br>
                        <span class="text-sm text-gray-400">Select a menu if available to view details or add a new
                            menu.</span>
                    </p>
                </div>
            </div>
            <div class="px-6 pb-6 overflow-y-auto card-content sideMenu-tabs-content">
                <div class="flex flex-col gap-3 text-lg">
                    <p class="text-lg font-medium text-center text-red-500">
                        No Menu Details was Found <br>
                        <span class="text-sm text-gray-400">Select a menu if available to view details or add a new
                            menu.</span>
                    </p>
                </div>
            </div>
        @endisset
    </div>
    <div class="flex items-center w-full gap-3 p-4 mt-auto bg-white shadow-inner footer-toggle">
        <!-- Label -->
        <label for="{{ $submitId }}"
            class="w-full h-12 text-center cursor-pointer items-center justify-center flex !text-white rounded-full bg-secondary-accent-color">
            Update
        </label>
    </div>
</aside>
