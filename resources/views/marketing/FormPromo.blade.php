@extends('templates.sidebar')

@section('container')
<h3 class="mb-4 text-4xl font-extrabold leading-none tracking-tight">@if ($data[0] != null) Edit Paket @else Buat Paket @endif</h3>
  @if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
  @endif
  {{-- {{ dump($data[0]) }} --}}
 @if ($data[0] != null)
    <div>
        <input type="hidden" name="ID" id="promoid" value="{{$data[0]['id']}}">
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Paket</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="nama" id="nama" value="{{$data[0]['nama']}}" placeholder="nama promo">
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Paket</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="deskripsi" id="deskripsi" value="{{$data[0]['deskripsi']}}" placeholder="deskripsi">
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masa Aktif Paket</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="date" name="masa_aktif" id="masa_aktif" value="{{$data[0]['masa_aktif']}}" >
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Paket</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="potongan_harga" id="potongan_harga" value="{{$data[0]['potongan_harga']}}" placeholder="10000">
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Paket</label>
            <label class="relative inline-flex items-center cursor-pointer">
                <input id="checked-status" type="checkbox" class="sr-only peer" @if ($data[0]['status'] == 1) checked @else @endif>
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Status</span>
            </label>
        </div>
        <div class="mb-2">
            <button class="simpan text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">SIMPAN</button>
        </div>
    </div>
 @else
      <div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Paket</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="nama" id="nama" placeholder="Paket 100Mbps">
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Paket</label>
            <textarea class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="deskripsi" id="deskripsi" placeholder="deskripsi"></textarea></div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masa Aktif Paket</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="date" name="masa_aktif" id="masa_aktif" >
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Paket</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="potongan_harga" id="potongan_harga" placeholder="10000">
        </div>
        <div class="mb-2">
            <button class="simpan text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">SIMPAN</button>
        </div>
      </div>
 @endif
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
@endsection