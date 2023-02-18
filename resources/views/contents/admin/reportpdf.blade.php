<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Laporan Pengaduan</title>
</head>

<body>
    <div class="text-center mb-4">
        <h5>Laporan Pengaduan Masyarakat</h5>

    </div>
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Pelapor</th>
                    <th>Lokasi Kejadian</th>
                    <th>Tanggal</th>
                    <th>Isi Laporan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengaduan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->nik }}</td>
                    <td>{{ $item->user->nama }}</td>
                    <td>{{ $item->lokasi_kejadian }}</td>
                    <td>{{ $item->tgl_pengaduan }}</td>
                    <td>{{ $item->isi_laporan }}</td>
                    <td>{{ $item->status == '0' ? 'Pending' : ucwords($item->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>