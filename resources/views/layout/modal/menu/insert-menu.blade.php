<dialog id="modal-add-product" class="relative m-auto w-fit h-fit">
    <form action="{{ Route('create.new.product') }}" class="w-[65rem]" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-content">
            <div class="grid h-full grid-cols-2 gap-6 text-lg auto-rows-auto">
                <!-- Image Container -->
                <div class="relative w-full h-full overflow-hidden rounded-lg img-file-management">
                    <!-- Display Image -->
                    <img src="" class="object-cover w-full h-full rounded-lg img-preview" alt=""
                        onerror="this.onerror=null; this.src='https://salonlfc.com/wp-content/uploads/2018/01/image-not-found-1-scaled.png';" />

                    <input type="file" name="image" id="AddProduct" class="hidden file-img-product" />
                    <label for="AddProduct"
                        class="absolute px-8 text-base py-1.5 font-medium translate-x-1/2 bg-white rounded-full cursor-pointer outline outline-1 bottom-5 w-fit right-1/2">
                        Choose File
                    </label>
                    <label
                        class="p-2 hidden rounded-t-lg top-0 backdrop-blur-lg bg-secondary-accent-color-admin error-message absolute font-medium text-center !text-black">
                        File harus berupa gambar (jpg, jpeg, png) dan ukuran maksimal 2MB.
                    </label>
                </div>
                <!-- Error Message -->
                <div class="flex flex-col gap-3 wrap">
                    <!-- Product Name Input -->
                    <label for="" class="flex flex-col gap-3">
                        Product Name
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                            placeholder="Max 20 Char" />
                    </label>

                    <!-- Description Input -->
                    <label for="" class="flex flex-col gap-3">
                        Description
                        <textarea name="menu_description" rows="4"
                            class="p-3 rounded-lg outline-none resize-none bg-secondary-color-admin" id="" placeholder="Max 150 Char">{{ old('menu_description') }}</textarea>
                    </label>

                    <!-- Categories Dropdown -->
                    <label for="menu_type">Categories</label>
                    <select name="menu_type" value="{{ old('menu_type') }}"
                        class="relative p-3 rounded-lg outline-none bg-secondary-color-admin" id="menu_type">
                        <option value="pizza">pizza</option>
                        <option value="coffee">coffee</option>
                        <option value="bobba">bobba</option>
                    </select>

                    <!-- Status Dropdown -->
                    <label for="Active">Status</label>
                    <select name="is_active" value="{{ old('is_active') }}"
                        class="relative p-3 rounded-lg outline-none bg-secondary-color-admin" id="Active">
                        <option value="1">Active</option>
                        <option value="0">Non-Active</option>
                    </select>
                    <!-- Stock Input -->
                    <label for="" class="flex flex-col gap-3">
                        Stock
                        <input type="number" name="stock" value="{{ old('stock') }}"
                            class="w-full p-3 rounded-lg outline-none bg-secondary-color-admin"
                            placeholder="Max 20 Char" />
                    </label>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between w-full gap-3 wrap">
                        <button type="reset"
                            class="w-full py-2.5 text-center rounded-lg outline outline-1 outline-gray-300 text-secondary-accent-color bg-secondary-accent-color-admin btn">
                            Cancle
                        </button>
                        <button type="submit" class="w-full py-2.5 bg-black  !text-white btn text-center rounded-lg">
                            Insert
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Close Button -->
    <button id="close-btn" class="absolute right-3 top-3 text-secondary-accent-color">
        <i class="text-2xl ti ti-x"></i>
    </button>
</dialog>
