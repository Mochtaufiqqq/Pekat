<!DOCTYPE html>
<html lang="en">

@include('includes.pdf.head')

    
<body>
    <div class="text-center">
        <h4>Laporan Pengaduan</h4>
    </div>
    <div class="container">
        <table class="table bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Pelapor</th>
                    <th>Lokasi Kejadian</th>
                    <th>Tanggal</th>
                    <th>Deskripsi Laporan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($complaint as $item)
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