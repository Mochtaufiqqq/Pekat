@extends('layouts.user.master')


@section('title','Detail Pengaduan')

@section('content')
{{-- Section Header --}}
@include('contents.user.nav')

{{-- Section Card --}}


<div class="container">
    <div class="single-pengaduan">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 col">
                <div class="single single-top shadow mb-5">
                    
                    @if ($pengaduan->hide_identitas == 2)
                    <img src="{{ asset('/images/anonim.png') }}" alt="profile" class="single-profile">
    
                    @elseif($pengaduan->user->foto_profil)
                    <img src="{{ asset($pengaduan->user->foto_profil) }}" alt="profile" class="single-profile gambar-lampiran"
                        data-toggle="modal" data-target="#imageModal" data-src="{{ asset($pengaduan->user->foto_profil) }}">
    
                    @else
                    <img src="{{ asset('/images/user_default.svg') }}" alt="profile" class="single-profile">
                    @endif
                   <div class="d-flex ">
                    <div>
                        @if ($pengaduan->hide_identitas == 2)
                        <p>Anonymous</p>
                        @else
                        <p>{{ $pengaduan->user->nama }}</p>
                        @endif
                        @if ($pengaduan->status == '0')
                        <p class="text-danger">Pending</p>
                        @elseif($pengaduan->status == 'proses')
                        <p class="text-warning">{{ ucwords($pengaduan->status) }}</p>
                        @else
                        <p class="text-success">{{ ucwords($pengaduan->status) }}</p>
                        @endif

                    </div>
                    {{-- <div>
                        @if ($pengaduan->hide_laporan == 2 || $pengaduan->hide_identitas == 2)
                        <p class="ml-5 mt-1 text-muted" style="font-size: 15px; "><i class="fas fa-globe-asia" style="font-size: 14px; color: #2d6eba;"></i>&nbsp;</p>
                        @else
                        <p class="ml-5 mt-1 text-muted" style="font-size: 15px; "><i class="fas fa-lock" style="font-size: 14px; color: #2d6eba;"></i>&nbsp;{{ $pengaduan->Kategori->kategori }}</p>
                        @endif
                        
                    </div> --}}
                    <div>
                        @if ($pengaduan->Kategori != '')
                        <p class="ml-5 mt-1 text-muted" style="font-size: 15px; "><i class="fas fa-tags" style="font-size: 14px; color: #2d6eba;"></i>&nbsp;{{ $pengaduan->Kategori->kategori }}</p>
                        @endif
                    </div>
                    <div>
                        <p class="ml-2 mt-1 text-muted" style="font-size: 15px;"><i class="fa fa-calendar-alt" style="font-size: 14px;"></i>&nbsp;{{ $pengaduan->tgl_pengaduan->format('d M Y, h:i') }}</p>
                    </div>
                </div>
                <div class="single-mid">
                    <div class="judul-laporan">
                        {{ $pengaduan->judul_laporan }}
                    </div>
                    <div>
                        <p>{{ $pengaduan->isi_laporan }}</p>
                    </div>
                   </div>
                   <div class="single-bottom">
                                       
                    @if ($pengaduan->Images != '')
                    @foreach ($pengaduan->Images as $key => $item)

                    <img src="{{ asset('storage/complaint-images/' .$item->folder. '/' .$item->image) ?? ''}}" 
                    class="gambar-lampiran mb-3" data-toggle="modal" data-target="#imageModal"
                        data-src="{{ asset('/storage/complaint-images/' .$item->folder. '/' .$item->image) ?? '' }}">

                    @endforeach
                    @endif

                    @if ($pengaduan->Location && $pengaduan->Location->location != '')
                    <p>
                        
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $pengaduan->Location->latitude }},{{ $pengaduan->Location->longitude }}"> 
                            <i class="fas fa-map-marker-alt"></i> 
                            <small class="text-muted">{{ $pengaduan->Location->location ?? '' }}, {{ $pengaduan->Location->latitude ?? '' }}, {{ $pengaduan->Location->longitude }}</small>
                          </a>
                    </p>
                
                    @endif

                    @if ($pengaduan->status == 0)
                    <p class="mt-3 mb-2">
                        <a href="/pengaduan/me/edit/{{ $pengaduan->id_pengaduan }}" style="text-decoration: none;">Edit</a>
                        <a class="ml-3" data-toggle="modal"
                            data-target="#modalDelete{{ $pengaduan->id_pengaduan }}"
                            href="/pengaduan/me/delete/{{ $pengaduan->id_pengaduan }}" style="text-decoration: none;">Hapus</a>
                    </p>
                    @endif

                    

                </div>
                @if ($pengaduan->tanggapan != null)
                    <hr>
                    <div class="single-footer">

                        <img src="{{ asset('/images/user_default.svg') }}" alt="">
                        <div class="d-flex" style="flex: 5;">
                        <p class="top mb-2" style="line-height: 1;">{{ $pengaduan->tanggapan->petugas->nama_petugas }}</p>
                            
                        </div>
                        <p class="bottom" style="font-size: 15px;">{{ $pengaduan->tanggapan->tanggapan }}</p>
                    </div>
                    @endif
                   </div>
                   
                </div>
            </div>
        </div>
    </div>


    <div class="container">
      <div class="row justify-content-center">
        @if (Auth::guard('masyarakat')->check())
            
        <a href="/pengaduan/me" style="text-decoration: none">< Kembali</a>
        @else
        <a href="/home" style="text-decoration: none">< Kembali</a>
        @endif
      </div>
    </div>

    <!-- Modal image -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-ctn">
        <div class="modal-body text-center">
            <img id="modalImage" src="" alt="" style="width: 100%; height: auto;">
        </div>
    </div>
</div>
</div>
{{-- end modal image --}}
@endsection

