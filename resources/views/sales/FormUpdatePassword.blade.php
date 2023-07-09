@extends('templates.sidebar')

@section('container')
<h3 class="mb-4 text-4xl font-extrabold leading-none tracking-tight">Update Password</h3>
  @if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
  @endif
  <div>
    {{-- @dump($id) --}}
    <input type="hidden" name="cusid" id="cusid" value="{{$id}}">
    <div class="mb-2">
        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <label class="bg-gray-300 hover:bg-gray-400 rounded px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-password-label1" for="toggle" style="position: absolute;
        right: 0;
        margin-right: 51px;
        height: 42px;
        line-height: 2.3;">show</label>
        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="password" name="firstPw" id="firstPw" placeholder="••••••••">
    </div>
    <div class="mb-2">
        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
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
        console.log($('#paket').val() != null)
    })

    $(document).on('click', '.js-password-label', function(event){
        // console.log($('#password').attr('type') === 'password')
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

    $(document).on('click', '.js-password-label1', function(event){
        // console.log($('#firstPw').attr('type') === 'password')
        let password = $('#firstPw').attr('type')
        let passwordLabel = $(this).text()
        if (password === 'password') {
            $('#firstPw')[0].type = 'text'
            $(this).text('hide')
        } else {
            $('#firstPw')[0].type = 'password'
            $(this).text('show')
        }
    })

    $(document).on('click', '.simpan', function(e){
        e.preventDefault()
        let getID = 0;
        // console.log(foto,'aaa')
        if ($('#cusid').val() != null) {
            getID = $('#cusid').val();
        }
        let password = $('#firstPw').val()
        let realPassword = $('#password').val()

        if (realPassword != password || password != realPassword) {
            alert('Password Tidak Sama');
        } else {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
            });
            $.ajax({
                type: 'POST',
                url: "{{route('savePassword')}}",
                data: {
                    ID : getID,
                    password : realPassword
                },
                dataType: 'json',
                // processData: false, contentType: false,
                // enctype: 'multipart/form-data',
                success: function(data) {
                    alert('Password berhasil diganti');
                    if(data.message == 'Berhasil'){
                        window.location.href = `{{ url('/customer') }}`
                    }
                },
                error: function(data) {
                    console.log(data);
                }

            })
        }
        
    });
</script>
@endsection