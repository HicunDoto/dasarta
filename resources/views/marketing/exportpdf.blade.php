<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1 style="text-align: center;">{{ $title }} - {{ $date }}</h1>
    <p style="text-align: center;">Perolehan Data Customer yang sudah membeli.</p>
  
    <table class="table table-bordered">
        <tr>
            <th>Nama Customer</th>
            <th>Nik Customer</th>
            <th>Paket yang Dibeli</th>
            <th>Harga Paket</th>
            <th>Sales</th>
        </tr>
        @foreach($data as $datas)
        <tr>
            <td>{{ $datas->customer->nama }}</td>
            <td>{{ $datas->customer->nik }}</td>
            <td>{{ $datas->paket->nama }}</td>
            <td>{{ $datas->paket->potongan_harga }}</td>
            <td>{{ $datas->sales->name }}</td>
        </tr>
        @endforeach
    </table>
  
</body>
</html>