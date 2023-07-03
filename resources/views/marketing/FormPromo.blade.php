<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/flowbite.min.css" rel="stylesheet" />
  @vite('resources/css/app.css')
</head>
<body>
  <h1 class="text-3xl font-bold underline">
    Hello world!
  </h1>
  @if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
  @endif
 {{-- @dump($data[0]['nama']) --}}
 @if ($data[0] != null)
    {{-- <form action="{{url('/api/program')}}" method="post" enctype="multipart/form-data"> --}}
    {{-- <form  method="post"> --}}
    {{-- @csrf --}}
    <input type="hidden" name="ID" id="promoid" value="{{$data[0]['id']}}">
    <input type="text" name="nama" id="nama" value="{{$data[0]['nama']}}" placeholder="nama promo">
    <input type="text" name="deskripsi" id="deskripsi" value="{{$data[0]['deskripsi']}}" placeholder="deskripsi">
    <input type="date" name="masa_aktif" id="masa_aktif" value="{{$data[0]['masa_aktif']}}" >
    <input type="number" name="potongan_harga" id="potongan_harga" value="{{$data[0]['potongan_harga']}}" placeholder="10000">
    <label class="relative inline-flex items-center cursor-pointer">
        <input id="checked-status" type="checkbox" class="sr-only peer" @if ($data[0]['status'] == 1)
            checked
        @else
            
        @endif>
        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Status</span>
      </label>
    <button class="simpan">SIMPAN</button>
    {{-- </form> --}}
 @else
    <form action="{{url('/api/program')}}" method="post" enctype="multipart/form-data">
    {{-- <form  method="post"> --}}
    @csrf
    <input type="text" name="nama" id="nama" placeholder="nama promo">
    <input type="text" name="deskripsi" id="deskripsi" placeholder="deskripsi">
    <input type="date" name="masa_aktif" id="masa_aktif" >
    <input type="number" name="potongan_harga" id="potongan_harga" placeholder="10000">
    <button class="simpan">SIMPAN</button>
    </form>
 @endif
</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(document).ready( function () {
        console.log($('#promoid').val() != null)
    })
    $(document).on('click', '.simpan', function(event){
        // console.log()
        let nama = $('#nama').val();
        let deskripsi = $('#deskripsi').val();
        let masaAktif = $('#masa_aktif').val();
        let potHarga = $('#potongan_harga').val();
        let checkboxStatus = 0;
        let getID = 0;
        if ($('#checked-status').is(':checked')) {
            checkboxStatus = 1;
        }

        if ($('#promoid').val() != null) {
            getID = $('#promoid').val();
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('saveProgram')}}",
            data: {
                ID : getID,
                nama: nama,
                deskripsi: deskripsi,
                masa_aktif: masaAktif,
                potongan_harga: potHarga,
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/flowbite.min.js"></script>
</html>