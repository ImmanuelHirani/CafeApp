$(document).ready(function () {
    $("#orderTable").DataTable({
        lengthMenu: [[10], ["10"]],
        paging: true,
        responsive: true,
        autoWidth: false, // Set autoWidth to false
        searching: true,
        ordering: true,
        info: true,
        language: {
            // Konfigurasi bahasa lainnya
            lengthMenu: "Recent Order : _MENU_  per halaman",
            zeroRecords: "Tidak ditemukan data yang sesuai",
            info: "Menampilkan _PAGE_ dari _PAGES_ halaman",
            infoEmpty: "Tidak ditemukan data yang sesuai",
            infoFiltered: "(Disaring dari _MAX_ data keseluruhan)",
            search: "Cari : ",
            searchPlaceholder: "Masukkan kata kunci", // Menambahkan placeholder
            paginate: {
                previous: '<i class="ti ti-chevron-left"></i>',
                next: '<i class="ti ti-chevron-right"></i>',
            },
        },
    });
});

$(document).ready(function () {
    $("#tableCustomers").DataTable({
        lengthMenu: [[10], ["10"]],
        paging: true,
        responsive: true,
        autoWidth: false, // Set autoWidth to false
        searching: true,
        ordering: true,
        info: true,
        language: {
            // Konfigurasi bahasa lainnya
            lengthMenu: "Customers : _MENU_  per halaman",
            zeroRecords: "Tidak ditemukan data yang sesuai",
            info: "Menampilkan _PAGE_ dari _PAGES_ halaman",
            infoEmpty: "Tidak ditemukan data yang sesuai",
            infoFiltered: "(Disaring dari _MAX_ data keseluruhan)",
            search: "Cari : ",
            searchPlaceholder: "Masukkan kata kunci", // Menambahkan placeholder
            paginate: {
                previous: '<i class="ti ti-chevron-left"></i>',
                next: '<i class="ti ti-chevron-right"></i>',
            },
        },
    });
});
