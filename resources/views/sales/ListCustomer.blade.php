@extends('templates.sidebar')

@section('title','Customer')

@section('container')
<h3 class="mb-4 text-4xl font-extrabold leading-none tracking-tight">List Customer</h3>
<a href="{{ url('/addcustomer') }}" class="btn-tambah-paket focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah Customer</a>
  <table id="table" class="table-fixed">
    <thead>
      <tr>
        <th>Aksi</th>
        <th>Nama</th>
        <th>Nomer KTP</th>
        <th>Paket yang di beli</th>
        <th>Sales</th>
      </tr>
    </thead>
    
  </table>
<script>
    var getID = 0;
    // console.log($('.idpromo').data('id'))
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        $('#table').DataTable({
            responsive: true,
            processing: false,
            serverSide: true,
            ordering: true,
            scrollX: true,
            sScrollXInner: "100%",
            scrollCollapse: true,
            fixedColumns: true,
            fixedHeader: true,
            ajax: {
                url : "{{route('getCustomer')}}",
                data : function (d) {
                    
                },
            },
            order: [
                // [0, 'desc']
            ],
            deferRender : true,
            columnDefs : [
                {
                    "orderable" : false,
                    "targets" : [0],
                }
            ]
        });
    });

    $(document).on('click', '#checked-status',function(){
    let checkboxStatus = 0;
      if ($(this).is(':checked')) {
          checkboxStatus = 1;
      }
      getID = $(this).parents('tr').find('.valueID').val()
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('saveStatus')}}",
            data: {
                ID : getID,
                status: checkboxStatus
            },
            dataType: 'json',
            success: function(data) {
                alert('data berhasil disimpan');
                if(data.message == 'Berhasil'){
                    window.location.href = `{{ url('/program') }}`
                }
            },
            error: function(data) {
                console.log(data);
            }

        })
    });
</script>

@endsection