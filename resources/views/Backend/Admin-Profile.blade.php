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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    @vite('resources/css/app.css')
</head>

<body id="Admin">
    @include('layout.header')

    <main class="grid grid-cols-12 gap-4 py-4">
        <section class="flex flex-col col-span-12 p-6 rounded-lg gap-9 bg-primary-color-admin">
            <div class="flex flex-col gap-3 overflow-x-auto">
                <p class="text-2xl">Personal Information</p>
                <hr>
                <form enctype="multipart/form-data" method="POST"
                    action="{{ route('admin.profile.update', $user->user_ID) }}"
                    class="flex flex-col-reverse items-center w-full grid-cols-12 gap-8 my-3 md:gap-16 md:grid profile-wrap">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col w-full col-span-8 gap-3 md:gap-6 wrap">
                        <div class="flex flex-col items-center w-full md:flex-row wrap">
                            <label for="username" class="text-lg md:w-[30%] w-full">Username</label>
                            <input name="username" id="username" type="text" placeholder="Max 20 Char"
                                value="{{ $user->username ?? 'Not Set Username Yet' }}"
                                class="md:w-[70%] bg-secondary-accent-color-admin w-full px-4 py-2 text-gray-500 rounded-lg">
                        </div>
                        <div class="flex flex-col items-center w-full md:flex-row wrap">
                            <label for="email" class="text-lg md:w-[30%] w-full">Email</label>
                            <input name="email" id="email" type="text" placeholder="Email"
                                value="{{ $user->email ?? 'Not Set Email Yet' }}"
                                class="md:w-[70%] bg-secondary-accent-color-admin w-full px-4 py-2 text-gray-500 rounded-lg">
                        </div>
                        <div class="flex flex-col items-center w-full md:flex-row wrap">
                            <label for="phone" class="text-lg md:w-[30%] w-full">Phone</label>
                            <input name="phone" id="phone" type="text" placeholder="Phone Number"
                                value="{{ $user->phone ?? 'Not Set Phone Yet' }}"
                                class="md:w-[70%] bg-secondary-accent-color-admin w-full px-4 py-2 text-gray-500 rounded-lg">
                        </div>
                        <div class="flex flex-col items-center w-full md:flex-row wrap">
                            <label for="user_role" class="text-lg md:w-[30%] w-full">User Role</label>
                            <label
                                class="md:w-[70%] bg-secondary-accent-color-admin w-full px-4 py-2 text-gray-500 rounded-lg">{{ $user->user_type ?? 'Role Not Set Yet' }}</label>
                        </div>
                        <button type="submit" class="self-end w-full px-8 py-2 bg-green-600 rounded-lg md:w-fit">Update
                            Data</button>
                    </div>
                    <div class="flex items-center justify-center w-full h-full col-span-4 border-2 rounded-lg">
                        <div class="flex flex-col items-center gap-6 wrap">
                            <img class="md:w-[8rem] w-[12rem] h-[12rem] md:h-[8rem] rounded-full object-cover img-preview"
                                src="{{ $user->image ? asset('storage/' . $user->image) : 'https://salonlfc.com/wp-content/uploads/2018/01/image-not-found-1-scaled.png' }}"
                                alt="Image Preview">
                            <input name="image" id="file" type="file" class="hidden file-img-product">
                            <label for="file"
                                class="px-8 py-2 rounded-lg cursor-pointer h-fit w-fit outline-1 outline outline-gray-300">Choose
                                Image</label>
                            <p class="hidden !text-red-500 error-message">File harus berupa gambar dengan format .JPEG,
                                .PNG, atau .JPG
                            </p>
                        </div>
                    </div>
                </form>

                <hr>
            </div>
        </section>
    </main>
</body>
<script src="{{ asset('/js/table.js') }}"></script>
<script src="{{ asset('/js/selectedStatus.js') }}"></script>
<script src="{{ asset('/js/imgPicker.js') }}"></script>
{{-- <script src="{{ asset('/js/tabs-sideMenu.js') }}"></script>
<script src="{{ asset('/js/imgPicker.js') }}"></script>
<script src="{{ asset('/js/tabs-menu.js') }}"></script>
<script src="{{ asset('/js/modal.js') }}"></script>
<script src="{{ asset('/js/pagginationPage.js') }}"></script> --}}

</html>
