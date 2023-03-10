<link rel="stylesheet" href="{{ asset('/css/landing.css') }}">
<link rel="stylesheet" href="{{ asset('/css/laporan.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

<link rel='stylesheet' href='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'>
<link rel='stylesheet' href='https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css'>

{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" rel="stylesheet"> --}}

{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}

<style>
    #scroll-to-top-btn {
        background-color: #0a2647;
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        width: 50px;
        height: 50px;
        border-radius: 20px 20px 20px 20px;
        color: white;
        z-index: 1001;
        transition: background-color 0.5s ease;

        /* opacity: 20px; */
    }

    #scroll-to-top-btn:hover {
        background-color: #031a34;
    }
</style>

<style>
    #leafletMap-registration {
        height: 200px;

        /* The height is 400 pixels */
    }
</style>

{{-- <style>
    .toastify {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        line-height: 1.5;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        color: #fff;
    }

    .toastify-error {
        background-color: #ff4757;
    }

    .toastify-warning {
        background-color: #f1c40f;
    }

    .toastify-success {
        background-color: #2ecc71;
    }
</style> --}}