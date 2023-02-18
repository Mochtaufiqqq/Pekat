@extends('layouts.admin.master')

@section('title','Detail Masyarakat')

@section('content')

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">

                <h3>Detail Masyarakat</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/masyarakat">Masyarakat</a></li>
                    {{-- <li class="breadcrumb-item"> <a href="/useraktif"></a> User Aktif</li>
                    <li class="breadcrumb-item active"><a href="/usernonaktif"></a> User Nonaktif</li> --}}
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->


<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Profil Masyarakat</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#"
                                data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                    class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                        <div class="row list-persons" id="addcon">
                            <div class="col">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane contact-tab-0 tab-content-child fade show active" id="#"
                                        role="tabpanel" aria-labelledby="v-pills-user-tab">
                                        <div class="profile-mail">
                                            <div class="media align-items-center">

                                                <img class="img-100 img-fluid m-r-20 rounded-circle update_img_0"
                                                    src="{{ asset('/default/user.png') }}" alt="">


                                                <input class="updateimg" type="file" name="img"
                                                    onchange="readURL(this,0)">
                                                <div class="media-body mt-0">
                                                    <h5>
                                                        <span class="first_name_0">{{ $society->username }} (</span>

                                                        <span class="last_name_0">{{ $society->nama }}

                                                            )</span>
                                                        @if ($society->foto_ktp == '' || $society->alamat == '' || $society->email == '' || $society->telp == '')
                                                        <small class="text-danger">!</small>
                                                        
                                                        @else
                                                        <small class="text-succes">✓</small>
                                                        @endif
                                                    </h5>
                                                    <p class="email_add_0">{{ $society->nik }}</p>
                                                    <ul>
                                                        <li><a href="/admin/masyarakat/delete/{{ $society->nik }}"
                                                                onclick="editContact(0)">Edit</a></li>
                                                        <li><a href="/admin/masyarakat/delete/{{ $society->nik }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalDelete{{ $society->nik }}">Hapus</a>
                                                        </li>

                                                        {{-- modal delete --}}
                                                        <div class="modal fade" id="modalDelete{{ $society->nik }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Hapus Masyarakat</h5>
                                                                        <button class="btn-close" type="button"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah anda yakin ingin menghapus
                                                                            {{ $society->nama }} ?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary" type="button"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <form
                                                                            action="/admin/masyarakat/delete/{{ $society->nik }}"
                                                                            method="POST">
                                                                            @method('delete')
                                                                            @csrf

                                                                            <button class="btn btn-primary"
                                                                                type="submit">Yakin</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="email-general">
                                                <h6 class="mb-3">Profil</h6>
                                                <ul>
                                                    <li>Email <span
                                                            class="font-primary first_name_0">{{ $society->email }}</span>
                                                    </li>
                                                    <hr>
                                                    <li>Alamat <span
                                                            class="font-primary first_name_0">{{ $society->alamat }}</span>
                                                    </li>
                                                    <hr>
                                                    <li>No Telp<span class="font-primary">
                                                            {{ $society->telp }}</span>
                                                    </li>
                                                    <hr>
                                                    <li>Tgl Lahir<span class="font-primary">
                                                            {{ $society->tgl_lahir }}</span>
                                                    </li>
                                                    <hr>
                                                    <li>Foto KTP<span class="font-primary">

                                                        </span>
                                                       <div class="col-sm-6">
                                                        <img class="gambar-lampiran" src="{{ asset($society->foto_ktp) }}" alt="" width="200" data-bs-toggle="modal" data-bs-target="#imageModal" data-src="{{ asset($society->foto_ktp) }}">
                                                       </div>
                                                    </li>
                                                    <hr>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="contact-editform" style="display: none;">
                                    <form>
                                        <div class="row g-2">
                                            <div class="mt-0 mb-3 col-md-12">
                                                <label>Name</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input class="form-control" id="first_name" type="text"
                                                            required="" placeholder="First Name" value="first_name">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" id="last_name" type="text"
                                                            required="" placeholder="Last Name" value="last_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-0 mb-3 col-md-12">
                                                <label>Email Address</label>
                                                <input class="form-control" id="email_add" type="text" required=""
                                                    autocomplete="off">
                                            </div>
                                            <div class="mt-0 mb-3 col-md-12">
                                                <label>Phone</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input class="form-control" id="mobile_num" type="text"
                                                            required="" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control">
                                                            <option>Mobile</option>
                                                            <option>Work</option>
                                                            <option>Others</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-2 more-data" style="display: none;">
                                            <div class="mt-0 mb-3 col-md-12">
                                                <label>URLS</label>
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6">
                                                        <input class="form-control" id="url_add" type="text"
                                                            required="">
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6">
                                                        <select
                                                            class="js-example-basic-single select2-hidden-accessible"
                                                            tabindex="-1" aria-hidden="true">
                                                            <option value="pw">Personal web address</option>
                                                            <option value="cw">Company web address</option>
                                                            <option value="fb">Fabebook URL</option>
                                                            <option value="tw">Twitter URL</option>
                                                        </select><span
                                                            class="select2 select2-container select2-container--default"
                                                            dir="ltr" style="width: auto;"><span class="selection"><span
                                                                    class="select2-selection select2-selection--single"
                                                                    role="combobox" aria-haspopup="true"
                                                                    aria-expanded="false" tabindex="0"
                                                                    aria-labelledby="select2-p10d-container"><span
                                                                        class="select2-selection__rendered"
                                                                        id="select2-p10d-container"
                                                                        title="Personal web address">Personal web
                                                                        address</span><span
                                                                        class="select2-selection__arrow"
                                                                        role="presentation"><b
                                                                            role="presentation"></b></span></span></span><span
                                                                class="dropdown-wrapper"
                                                                aria-hidden="true"></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-0 mb-3 col-md-12">
                                                <label>Personal</label>
                                                <div class="d-block">
                                                    <label class="me-3" for="edo-ani">
                                                        <input class="radio_animated" id="edo-ani" type="radio"
                                                            name="rdo-ani" checked=""><span>Male</span>
                                                    </label>
                                                    <label for="edo-ani1">
                                                        <input class="radio_animated" id="edo-ani1" type="radio"
                                                            name="rdo-ani"><span>Female</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mt-0 mb-3 col-md-12">
                                                <div class="row">
                                                    <div class="col-lg-2 col-sm-4">
                                                        <select class="form-control" id="birth_day">
                                                            <option class="f-w-600">Day</option>
                                                            <option>01</option>
                                                            <option>02</option>
                                                            <option>03</option>
                                                            <option>04</option>
                                                            <option>05</option>
                                                            <option>06</option>
                                                            <option>07</option>
                                                            <option>08</option>
                                                            <option>09</option>
                                                            <option>10</option>
                                                            <option>11</option>
                                                            <option>12</option>
                                                            <option>13</option>
                                                            <option>14</option>
                                                            <option>15</option>
                                                            <option>16</option>
                                                            <option>17</option>
                                                            <option>18</option>
                                                            <option>19</option>
                                                            <option>20</option>
                                                            <option>21</option>
                                                            <option>22</option>
                                                            <option>23</option>
                                                            <option>24</option>
                                                            <option>25</option>
                                                            <option>26</option>
                                                            <option>27</option>
                                                            <option>28</option>
                                                            <option>29</option>
                                                            <option>30</option>
                                                            <option>31</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-4">
                                                        <select class="form-control" id="birth_month">
                                                            <option class="f-w-600">Month</option>
                                                            <option>January</option>
                                                            <option>February</option>
                                                            <option>March</option>
                                                            <option>April</option>
                                                            <option>May</option>
                                                            <option>June</option>
                                                            <option>July</option>
                                                            <option>August</option>
                                                            <option>September</option>
                                                            <option>October</option>
                                                            <option>November</option>
                                                            <option>December</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-4">
                                                        <input class="form-control" id="birth_year" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-0 mb-3 col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>Personality</label>
                                                        <input class="form-control" id="personality" type="text"
                                                            required="" autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Interest</label>
                                                        <input class="form-control" id="interest" type="text"
                                                            required="" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label>Home Address</label>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <input class="form-control" type="text"
                                                                placeholder="Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input class="form-control" id="city" type="text"
                                                                placeholder="City">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input class="form-control" type="text" placeholder="State">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div>
                                                            <input class="form-control" type="text"
                                                                placeholder="Country">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div>
                                                            <input class="form-control" type="text"
                                                                placeholder="Pin Code">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><a class="ps-0 edit-information f-w-600" href="javascript:void(0)">Edit
                                            more information</a>
                                        <button class="btn btn-secondary update-contact" type="button">Save</button>
                                        <button class="btn btn-primary" type="button"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="mb-3">
                          <h6 class="form-label">Email : {{ $users->email }}</h6>
                    </div> --}}
                    <div class="form-footer text-end">
                        <a href="{{ url('/admin/masyarakat') }}"><button
                                class="btn btn-primary btn-block">Kembali</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

{{-- modal image --}}
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-ctn">
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')

<script>
    $(document).ready(function () {
        $('.gambar-lampiran').click(function () {
            var src = $(this).data('src');
            $('#modalImage').attr('src', src);
        });
    });
</script>

@endsection