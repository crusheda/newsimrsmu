$.extend(true, $.fn.dataTable.defaults, {
    dom: 'lfrtip',
    language: {
        searchPlaceholder: 'Cari Data...',
        sSearch: '',
        lengthMenu: "Tampilkan _MENU_ data",
        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
        paginate: {
            first: "Awal",
            last: "Akhir",
            next: "›",
            previous: "‹"
        }
    }
});