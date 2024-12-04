<aside id="showSelectedMenu"
    class="flex flex-col col-span-2 gap-8 pt-6 overflow-hidden rounded-lg bg-primary-color-admin">
    <div class="px-6 head-aside">
        <p class="text-xl font-semibold">Edit Products</p>
    </div>
    <div class="px-6 quick-link">
        <ul class="flex items-center justify-between w-full gap-3 text-base">
            <li
                class="relative w-full px-3.5 py-2 text-center transition-all duration-300 ease-in-out rounded-full cursor-pointer group outline-1 sideMenu-tabs-toggle">
                <a class="!text-accent-color-admin">Product Detail</a>
            </li>
            <li
                class="relative w-full px-3.5 py-2 text-center transition-all duration-300 ease-in-out rounded-full cursor-pointer group outline-1 sideMenu-tabs-toggle">
                <a class="!text-accent-color-admin">Inventory & Pricing</a>
            </li>
        </ul>
    </div>
    <form action="{{ route('update.menu', $menusDetails->menu_ID ?? '') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="px-6 pb-6 overflow-y-auto card-content sideMenu-tabs-content">
            <div class="flex flex-col gap-3 text-lg">
                <!-- Gambar Produk -->
                <div class="relative overflow-hidden img-file-management">
                    <img src="{{ asset('storage/' . ($menusDetails->image ?? '')) }}"
                        class="{{ $menusDetails->image ?? '' ? 'object-cover' : 'object-cover' }} w-full rounded-3xl img-preview h-72"
                        alt="{{ $menusDetails->name ?? 'Default Image' }}"
                        onerror="this.onerror=null; this.src='{{ asset('asset/Error-Image.png') }}';" />
                    <input type="file" id="imgUpload" name="image" class="hidden file-img-product" />
                    <label for="imgUpload"
                        class="absolute px-8 text-base py-1.5 font-medium translate-x-1/2 bg-white rounded-full cursor-pointer outline outline-1 bottom-5 w-fit right-1/2">
                        Choose File
                    </label>
                </div>
                <p class="hidden mt-2 error-message font-medium text-center !text-red-500">
                    File harus berupa gambar (jpg, jpeg, png).
                </p>
                <!-- Nama Produk -->
                <label for="menu_name" class="flex flex-col gap-3">
                    Product Name
                    <input type="text" name="name" value="{{ $menusDetails->name ?? '' }}"
                        class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin" placeholder="Max 20 Char" />
                </label>
                <!-- Deskripsi -->
                <label for="menu_description" class="flex flex-col gap-3">
                    Description
                    <textarea name="menu_description" rows="4"
                        class="p-3 rounded-lg outline-none resize-none bg-secondary-color-admin"
                        placeholder="Max 255 Char (only letters and spaces)">{{ $menusDetails->menu_description ?? '' }}</textarea>
                </label>

                <!-- Kategori -->
                <label for="menu_type">Menu Categories</label>
                <select name="menu_type" class="relative p-3 rounded-lg outline-none bg-secondary-color-admin">
                    <option value="pizza" {{ ($menusDetails->menu_type ?? '') == 'pizza' ? 'selected' : '' }}>Pizza
                    </option>
                    <option value="coffee" {{ ($menusDetails->menu_type ?? '') == 'coffee' ? 'selected' : '' }}>Coffee
                    </option>
                    <option value="bobba" {{ ($menusDetails->menu_type ?? '') == 'bobba' ? 'selected' : '' }}>Bobba
                    </option>
                </select>
                <!-- Status -->
                <label for="status">Status</label>
                <select name="is_active" class="relative p-3 rounded-lg outline-none bg-secondary-color-admin">
                    <option value="1" {{ ($menusDetails->is_active ?? '') == 1 ? 'selected' : '' }}>Active
                    </option>
                    <option value="0" {{ ($menusDetails->is_active ?? '') == 0 ? 'selected' : '' }}>Non-Active
                    </option>
                </select>
            </div>
        </div>

        <div class="px-6 pb-6 overflow-y-auto card-content sideMenu-tabs-content">
            <div class="flex flex-col gap-4 text-lg">
                <!-- Stock -->
                <label for="stock" class="flex flex-col gap-3">
                    Stock
                    <input type="number" name="stock" value="{{ $menusDetails->stock ?? '' }}"
                        class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin" placeholder="Max 20 Char" />
                </label>
                <!-- Harga Normal -->
                <label for="price" class="flex flex-col gap-3">
                    Normal price
                    <input type="number" name="price" value="{{ $menusDetails->price ?? '' }}"
                        class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin" min="0" />
                </label>
                <!-- Discount -->
                <label for="discount" class="flex flex-col gap-3">
                    Discount
                    <input type="number" class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                        min="0" />
                </label>
                <!-- Discount Member -->
                <label for="discount_member" class="flex flex-col gap-3">
                    Discount Number For Member Only
                    <input type="number" class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                        min="0" />
                </label>
            </div>
        </div>
        <input type="submit" id="update" value="Update" class="hidden">

    </form>
    <div class="flex items-center w-full gap-3 p-4 mt-auto bg-white shadow-inner footer-toggle">

        <label for="update"
            class="w-full h-12 text-center cursor-pointer items-center justify-center flex !text-white rounded-full bg-secondary-accent-color">
            Update
        </label>
    </div>
</aside>
