<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {

    $('#table').DataTable({
        searching: false,
        order: [[0, 'asc']],
    });

    getData();
});

$('.btn-get-data').click(function() {
    getData();
});

function getData() {

    $('#loading-filter').show();

    var dataTableObj = $('#table').DataTable();

    var kode = $('#filter-kode').val();
    var nama = $('#filter-nama').val();

    dataTableObj.clear().draw();

    $.ajax({
        url: '{{ url("categories/search") }}',
        dataType: 'json',

        data: {
            kode: kode,
            nama: nama
        },

        success: function(results) {

            $.each(results.data, function(index, item) {

                var html = `
                    <a href="{{ url('categories/view') }}/${item.kode}"
                       class="btn btn-primary">
                        View
                    </a>
                `;

                var row = [];

                row.push(item.kode);
                row.push(item.nama);
                row.push(html);

                dataTableObj.row.add(row).draw(false);
            });

            $('#loading-filter').hide();
        },

        error: function() {

            alert(
                'Terjadi kesalahan server, tidak dapat mengambil data'
            );

            $('#loading-filter').hide();
        }
    });
}
</script>