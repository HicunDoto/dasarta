@extends('templates.sidebar')

@section('container')
{{-- @dump($data) --}}
<h3 class="mb-4 text-4xl font-extrabold leading-none tracking-tight">@if ($data != null) Edit Customer @else Buat Customer @endif</h3>
  @if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
  @endif
 @if ($data != null)
 <form id="customer-data" action="{{route('saveCustomer')}}">
    <div>
        <input type="hidden" name="ID" id="cusid" value="{{$data[0]['id']}}">
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="nama" id="nama" value="{{$data[0]['nama']}}" placeholder="Achmad Waluyo">
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <textarea class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="alamat" id="alamat" placeholder="alamat">{{$data[0]['alamat']}}</textarea></div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomer Hp</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="no_hp" value="{{$data[0]['no_hp']}}" id="no_hp" >
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="nik" value="{{$data[0]['nik']}}" id="nik" >
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto KTP</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="file" value="{{$data[0]['foto_ktp']}}" name="file" id="file" >
            <img width="184" height="184" src="{{asset($data[0]['foto_ktp'])}}" alt="">
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
            <select id="jenis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if ($data[0]['jenis'] == 1)
                    <option selected value="1">Laki - laki</option>
                    <option value="0">Wanita</option>
                @else
                    <option value="1">Laki - laki</option>
                    <option selected value="0">Wanita</option>
                @endif
              </select>
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paket Yang Dipilih</label>
            <select id="paket" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($paket as $item)
                @if ($item->id == $penjualan[0]['paket_id'])
                    <option selected value="{{$penjualan[0]['paket_id']}}">{{$item->nama}}</option>
                @else
                    <option value="{{$item->id}}">{{$item->nama}}</option>
                @endif
                @endforeach
              </select>
        </div>
        <div class="mb-2">
            <button type="submit" class="simpan text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">SIMPAN</button>
        </div>
    </div>
</form>
 @else
      <form id="customer-data" action="{{route('saveCustomer')}}">
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="nama" id="nama" placeholder="Achmad Waluyo">
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <textarea class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="alamat" id="alamat" placeholder="alamat"></textarea></div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomer Hp</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="no_hp" id="no_hp" >
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="nik" id="nik" >
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto KTP</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="file" name="file" id="file" >
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
            <select id="jenis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1">Laki - laki</option>
                <option value="0">Wanita</option>
              </select>
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paket Yang Dipilih</label>
            <select id="paket" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($paket as $item)
                <option value="{{$item->id}}">{{$item->nama}}</option>
                @endforeach
              </select>
        </div>
        <div class="mb-2">
            <button type="submit" class="simpan text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">SIMPAN</button>
        </div>
    </form>
 @endif
<script>
    $(document).ready( function () {
        console.log($('#paket').val() != null)
    })
    $('#customer-data').submit(function(e){
        e.preventDefault()
        let getID = 0;
        // console.log(foto,'aaa')
        if ($('#cusid').val() != null) {
            getID = $('#cusid').val();
        }
        var fd = new FormData();    
        fd.append( 'foto', $('input[type="file"]')[0].files[0]);
        fd.append( 'nama', $('#nama').val());
        fd.append( 'alamat', $('#alamat').val());
        fd.append( 'no_hp', $('#no_hp').val());
        fd.append( 'jenis', $('#jenis').val());
        fd.append( 'paket', $('#paket').val());
        fd.append( 'nik', $('#nik').val());
        fd.append( 'ID', getID);
        console.log(fd)
        let nama = $('#nama').val();
        let alamat = $('#alamat').val();
        let noHp = $('#no_hp').val();
        let foto = $('input[type="file"]')[0].files[0];
        let jenis = $('#jenis').val();
        let paket = $('#paket').val();
        let nik = $('#nik').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('saveCustomer')}}",
            data: fd,
            // dataType: 'json',
            processData: false, contentType: false,
            // enctype: 'multipart/form-data',
            success: function(data) {
                alert('data berhasil disimpan');
                if(data.message == 'Berhasil'){
                    window.location.href = `{{ url('/sales') }}`
                }
            },
            error: function(data) {
                console.log(data);
            }

        })
    });
</script>
@endsection