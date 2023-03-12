@extends('layouts.user.master')


@section('content')

@section('title','Edit Pengaduan')


{{-- Section Header --}}
@include('contents.user.navwave')
{{-- Section Card Pengaduan --}}

<div class="row justify-content-center">
    <div class="col-lg-6 col-10 col">
        <div class="content shadow">

            {{-- @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
        @endif

        @if (Session::has('pengaduan'))
        <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
        @endif --}}

        <div class="card mb-3">Edit Pengaduan</div>
        <form action="/pengaduan/me/update/{{ $pengaduan->id_pengaduan }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            <input type="hidden" name="longitude" id="longitude" value="{{ $pengaduan->Location ? $pengaduan->Location->longitude : '' }}">
            <input type="hidden" name="latitude" id="latitude" value="{{ $pengaduan->Location ? $pengaduan->Location->latitude : '' }}">

    
            <div class="form-group">
                <label class="text-sm" for="judul_laporan">Judul Laporan</label>
                <input class="form-control" type="text" name="judul_laporan" placeholder="Masukan Judul Laporan"
                    value="{{ $pengaduan->judul_laporan }}">
                @if ($errors->has('judul_laporan'))
                <div class="text-danger-custom">{{ $errors->first('judul_laporan') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label class="text-sm" for="isi_laporan">Isi Laporan</label>
                <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control" rows="4"
                    value="{{ $pengaduan->isi_laporan }}">{{ $pengaduan->isi_laporan }}</textarea>
                @if ($errors->has('isi_laporan'))
                <div class="text-danger-custom">{{ $errors->first('isi_laporan') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label class="text-sm" for="tgl_pengaduan">Tanggal Kejadian</label>
                <input class="form-control" type="date" name="tgl_pengaduan" placeholder="Tanggal laporan"
                    value="{{ date('Y-m-d', strtotime($pengaduan->tgl_pengaduan)) }}">
                @if ($errors->has('tgl_pengaduan'))
                <div class="text-danger-custom">{{ $errors->first('tgl_pengaduan') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label class="text-sm" for="tgl_pengaduan">Lokasi Kejadian</label>
                <p>
                <small class="text-muted">Tentukan titik lokasi</small>
            </p>
                <div id="locationContent" class="mb-3">
                    <div id="leafletMap-registration" style=""></div>
                </div>
                <textarea class="form-control" name="lokasi_kejadian" id="address" rows="2"
                    placeholder="Lokasi kejadian"
                    value="{{ $pengaduan->Location ? $pengaduan->Location->location : '' }}">{{ $pengaduan->Location ? $pengaduan->Location->location : '' }}</textarea>
                @if ($errors->has('lokasi_kejadian'))
                <div class="text-danger-custom">{{ $errors->first('lokasi_kejadian') }}</div>
                @endif
            </div>
            

            <div class="form-group">
                <label for="id_kategori">Kategori</label>
                <select name="id_kategori" class="form-control">
                    <option disabled>Pilih kategori</option>
                    @foreach ($categories as $k)
                        <option value="{{ $k->id }}" {{ $pengaduan->id_kategori == $k->id ? 'selected' : '' }}>{{ $k->kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <a id="myButton"><i class="fas fa-paperclip" style="text-decoration: none; "></i> Lampiran</a>
            </div>

            <div class="form-group" id="myContent" style="display: none;">
                <input type="file" name="image" class='filepond' multiple data-allow-reorder="true" data-max-file-size="50MB" id="filepond">

                <div class="row mt-3">
                    @foreach($pengaduan->Images as $foto)
                    <div class="col-sm-4">
                        <div class="image-container" data-id="{{ $foto->id }}">
                            <img src="{{ asset('storage/complaint-images/'.$foto->folder.'/'.$foto->image) }}" width="200" height="auto">
                            <button class="btn btn-danger delete-btn"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <hr>
            <div class="form-check">
                <div class="row text-center mb-3">
                    <div class="col-6">
                        <input type="checkbox" name="hide_identitas" value="2" class="form-check-input"
                            data-toggle="tooltip" data-placement="top" title="Nama anda tidak akan terpublish"
                            {{ old('hide_identitas',$pengaduan->hide_identitas) == '2' ? 'checked' : '' }}>
                        <label class="form-check-label" for="exampleCheck1">Anonim</label>

                    </div>
                    <div class="col-6">
                        <input type="checkbox" name="hide_laporan" value="2" class="form-check-input"
                            data-toggle="tooltip" data-placement="top" title="Laporan anda tidak dapat dilihat publik"
                            {{ old('hide_laporan',$pengaduan->hide_laporan) == '2' ? 'checked' : '' }}>
                        <label class="form-check-label" for="exampleCheck1">Rahasia</label>
                    </div>
                </div>

            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-custom mt-2">Ubah</button>
            </div>
            {{-- <form action="/upload" class="dropzone" id="my-dropzone"></form>
                
            </form> --}}
    </div>
</div>
</div>


@endsection

@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');
</script>
@endif


<script>
    $(document).ready(function () {
        $('.delete-btn').click(function (e) {
            e.preventDefault();
            var container = $(this).closest('.image-container');
            var id = container.data('id');
            var url = "/pengaduan/image/delete";
            var token = "{{ csrf_token() }}";
            var data = {
                id: id,
                _token: token
            };

            $.ajax({
                url: url,
                type: 'DELETE',
                data: data,
                success: function (response) {
                    if (response.success) {
                        container.remove();
                        console.log('success');
                    } else {
                        alert('Failed to delete image!');
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>


<!-- Button trigger modal -->

{{-- <script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
    });
</script> --}}
@endsection