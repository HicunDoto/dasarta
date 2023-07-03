<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  @vite('resources/css/app.css')
</head>
<body>
  <table id="table" class="table-fixed">
    <thead>
      <tr>
        {{-- <th>Action</th> --}}
        <th>Aksi</th>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Masa Aktif</th>
        <th>Potongan Harga</th>
        <th>Status</th>
      </tr>
    </thead>
    
  </table>
</body>
<script>
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        $('#table').DataTable({
            responsive: false,
            processing: false,
            serverSide: true,
            ordering: true,
            scrollY: 400,
            scrollX: true,
            scrollCollapse: true,
            fixedColumns: true,
            ajax: {
                url : "{{route('getProgram')}}",
                data : function (d) {
                    
                },
            },
            order: [[0, 'desc']],
            deferRender : true,
            columnDefs : [
                {
                    "targets" : [0,1,2,3,4,5],
                }
            ]
        });
    });
</script>
</html>