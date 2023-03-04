@extends('layouts.user.master')


@section('content')

@section('title','Dashboard')


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
        @endif --}}

        {{-- @if (Session::has('pengaduan'))
            <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}
    </div>
    @endif --}}

    @if (Auth::guard('masyarakat')->user()->foto_ktp == '' && Auth::guard('masyarakat')->user()->tgl_lahir == '' &&
    Auth::guard('masyarakat')->user()->alamat == '' && Auth::guard('masyarakat')->user()->telp == '')
    <div class="alert alert-danger">Mohon lengkapi profil anda sebelum mengirim laporan</div>
    @else
    <div class="card mb-3">Tulis Laporan Disini</div>
    @endif

    <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="longitude" id="longitude">
        <input type="hidden" name="latitude" id="latitude">

        <div class="form-group">
            <label class="text-sm" for="judul_laporan">Kategori</label>
            <select name="id_kategori" class="form-control">
                <option selected disabled>Pilih Kategori</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->kategori }}</option>
                @endforeach
            </select>
            @if ($errors->has('id_kategori'))
            <div class="text-danger-custom">{{ $errors->first('id_kategori') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label class="text-sm" for="judul_laporan">Judul Laporan</label>
            <input class="form-control" type="text" name="judul_laporan" placeholder="Masukan Judul Laporan"
                value="{{ old('judul_laporan') }}">
            @if ($errors->has('judul_laporan'))
            <div class="text-danger-custom">{{ $errors->first('judul_laporan') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label class="text-sm" for="isi_laporan">Isi Laporan</label>
            <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                rows="4">{{ old('isi_laporan') }}</textarea>
            @if ($errors->has('isi_laporan'))
            <div class="text-danger-custom">{{ $errors->first('isi_laporan') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label class="text-sm" for="tgl_pengaduan">Tanggal Kejadian</label>
            <input name="tgl_pengaduan" type="text" class="form-control" placeholder="Masukan tanggal"
                onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="{{ old('tgl_pengaduan') }}">
            @if ($errors->has('tgl_pengaduan'))
            <div class="text-danger-custom">{{ $errors->first('tgl_pengaduan') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label class="text-sm" for="tgl_pengaduan">Lokasi Kejadian</label>
            <textarea class="form-control" name="lokasi_kejadian" id="address" rows="2" placeholder="Lokasi kejadian"
                value="{{ old('lokasi_kejadian') }}">{{ old('lokasi_kejadian') }}</textarea>
        @if ($errors->has('lokasi_kejadian'))
        <div class="text-danger-custom">{{ $errors->first('lokasi_kejadian') }}</div>
        @endif
</div>
<div id="locationContent" class="mb-3">
    <div id="leafletMap-registration" style=""></div>
</div>



<div class="mb-3">
    <a id="myButton"><i class="fas fa-paperclip" style="text-decoration: none; "></i> Lampiran</a>
    @if ($errors->has('images'))
    <div class="text-danger-custom">{{ $errors->first('images') }}</div>
    @endif
</div>

<div class="form-group" id="myContent" style="display: none;">

    <input type="file" name="image" class='filepond' multiple data-allow-reorder="true" data-max-file-size="50MB">
    {{-- <div id="preview-container"></div> --}}
</div>

<hr>
<div class="form-check">
    <div class="row text-center mb-3">
        <div class="col-6">
            <input type="checkbox" name="hide_identitas" value="2" class="form-check-input" data-toggle="tooltip"
                data-placement="top" title="Nama anda tidak akan terpublish" value="{{ old('hide_identitas') }}">
            <label class="form-check-label" for="exampleCheck1">Anonim</label>

        </div>
        <div class="col-6">
            <input type="checkbox" name="hide_laporan" value="2" class="form-check-input" data-toggle="tooltip"
                data-placement="top" title="Laporan anda tidak dapat dilihat publik" value="{{ old('hide_laporan') }}">
            <label class="form-check-label" for="exampleCheck1">Rahasia</label>
        </div>
    </div>

</div>

<div class="text-center mt-3">
    <button type="submit" class="btn btn-custom mt-2">Kirim</button>
</div>
</div>
</div>
</div>


@endsection

@section('js')


@if (Session::has('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session('
        success ') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif

@endsection