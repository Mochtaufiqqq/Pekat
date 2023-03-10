<!DOCTYPE html>
<html lang="en">

@include('includes.pdf.head')

    

<body>
    <div class="text-center">
        <center><h5>Laporan Data Masyarakat</h5></center>
    </div>
    <div class="container">
        <table class="table bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Tgl Lahir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($socities as $society)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $society->nik }}</td>
                    <td>{{ $society->nama }}</td>
                    <td>{{ $society->username }}</td>
                    <td>{{ $society->email }}</td>
                    <td>{{ $society->telp }}</td>
                    <td>{{ $society->alamat }}</td>
                    <td>{{ $society->tgl_lahir }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>