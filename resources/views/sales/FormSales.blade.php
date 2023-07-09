@extends('templates.sidebar')

@section('container')
<h3 class="mb-4 text-4xl font-extrabold leading-none tracking-tight">Buat Akun Sales</h3>
  @if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
  @endif
      <div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Sales</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="nama" id="nama" placeholder="Waluyo">
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="username" id="username" placeholder="username">
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="email" name="email" id="email" placeholder="waluyo@gmail.com">
        </div>
        <div class="mb-2">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <label class="bg-gray-300 hover:bg-gray-400 rounded px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-password-label" for="toggle" style="position: absolute;
            right: 0;
            margin-right: 51px;
            height: 42px;
            line-height: 2.3;">show</label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="password" name="password" id="password" placeholder="••••••••">
        </div>
        <div class="mb-2">
            <button class="simpan text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">SIMPAN</button>
        </div>
      </div>
<script>
    $(document).ready( function () {
        console.log($('#promoid').val() != null)
    })

    $(document).on('click', '.js-password-label', function(event){
        console.log($('#password').attr('type') === 'password')
        let password = $('#password').attr('type')
        let passwordLabel = $(this).text()
        if (password === 'password') {
            $('#password')[0].type = 'text'
            $(this).text('hide')
        } else {
            $('#password')[0].type = 'password'
            $(this).text('show')
        }
    })

    $(document).on('click', '.simpan', function(event){
        // console.log()
        let nama = $('#nama').val();
        let username = $('#username').val();
        let email = $('#email').val();
        let password = $('#password').val();
        // let checkboxStatus = 0;
        // let getID = 0;
        // if ($('#checked-status').is(':checked')) {
        //     checkboxStatus = 1;
        // }

        // if ($('#promoid').val() != null) {
        //     getID = $('#promoid').val();
        // }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('saveSales')}}",
            data: {
                // ID : getID,
                nama: nama,
                username: username,
                email: email,
                password: password
                // status: checkboxStatus
            },
            dataType: 'json',
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