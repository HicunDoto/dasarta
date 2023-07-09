<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>
<body>
      <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Login untuk masuk
                    </h1> 
                    @if (session('status'))
                      <div class="alert alert-danger">
                          {{ session('status') }}
                      </div>
                    @endif
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="username" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div class="flex items-center justify-between">
                        </div>
                        <button type="submit" class="simpan w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login</button>
                </div>
            </div>
        </div>
      </section>
</body>
<script>
    $(document).on('click', '.simpan', function(event){
        // console.log()
        let username = $('#username').val();
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
            url: "{{route('postLogin')}}",
            data: {
                // ID : getID,
                username: username,
                password: password
                // status: checkboxStatus
            },
            dataType: 'json',
            success: function(data) {
                console.log(data)
                // alert('data berhasil disimpan');
                if(data.data == 'admin'){
                    window.location.href = `{{ url('/program') }}`
                }else{
                    window.location.href = `{{ url('/sales') }}`
                }
            },
            error: function(data) {
                alert('Username/Password Salah!')
            }

        })
    });
</script>
</html>