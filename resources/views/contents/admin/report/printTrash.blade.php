<!DOCTYPE html>
<html lang="en">

@include('includes.pdf.head')

    
<body>
    <div class="text-center">
        <center><h3>Laporan Pengaduan Yang Telah Dihapus</h3></center>
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
                    <th>Isi Laporan</th>
                    <th>Kategori</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($complaint as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->nik }}</td>
                    <td>{{ $item->user->nama }}</td>
                    <td>{{ $item->Location->location ?? '' }}</td>
                    <td>{{ $item->tgl_pengaduan }}</td>
                    <td>{{ $item->isi_laporan }}</td>
                    <td>{{ $item->Kategori->kategori ?? '' }}</td>
                    <td>{{ $item->status == '0' ? 'Pending' : ucwords($item->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>