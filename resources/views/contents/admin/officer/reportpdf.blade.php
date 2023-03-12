<!DOCTYPE html>
<html lang="en">

@include('includes.pdf.head')

    

<body>
    <div class="text-center">
        <center><h4>Laporan Data Petugas</h4></center>

    </div>
    <div class="container">
        <table class="table bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($officers as $officer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $officer->nama_petugas }}</td>
                    <td>{{ $officer->username }}</td>
                    <td>{{ $officer->email }}</td>
                    <td>{{ $officer->telp }}</td>
                    <td>{{ $officer->alamat }}</td>
                    <td>{{ $officer->level }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>