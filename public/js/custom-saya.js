// GLOBAL SETTING DATATABLE
$.extend(true, $.fn.dataTable.defaults, {
    dom: `
        <"d-flex flex-wrap justify-content-between align-items-center mb-2 gap-2"
            <"dt-buttons"B>
            <"d-flex align-items-center gap-2"
                <"dt-length"l>
                <"dt-search"f>
            >
        >
        rt
        <"d-flex flex-wrap justify-content-between mt-2"ip>
    `,
    buttons: [
        {
            extend: 'excel',
            text: 'Excel',
            className: 'btn btn-success-transparent'
        },
        {
            extend: 'pdf',
            text: 'PDF',
            className: 'btn btn-danger-transparent'
        },
        {
            extend: 'colvis',
            text: 'Kolom ',
            className: 'btn btn-info-transparent'
        }
    ],
    language: {
        searchPlaceholder: 'Tuliskan Kata Kunci...',
        sSearch: 'Cari Data ',
        lengthMenu: "Tampilkan _MENU_",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        infoEmpty: "Tidak ada data",
        infoFiltered: "(difilter dari _MAX_ total data)",
        zeroRecords: "Data tidak ditemukan",
        paginate: {
            first: "Awal",
            last: "Akhir",
            next: "›",
            previous: "‹"
        }
    },
    lengthChange: true,
    lengthMenu: [5, 10, 15, 20, 30, 35, 50, 75, 100, 500, 1000, 3000, 5000, 7000, 10000],
    displayLength: 20
});
$.extend(true, $.fn.dataTable.defaults, {
    initComplete: function () {
        $('.dataTables_wrapper').addClass('text-dark');
    }
});
