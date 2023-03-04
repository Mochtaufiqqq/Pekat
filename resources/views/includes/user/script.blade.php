<script src="{{ asset('/user/js/showform.js') }}"></script>
<script src="{{ asset('/user/js/tab.js') }}"></script>
<script src="{{ asset('/user/js/scroll.js') }}"></script>
<script src="{{ asset('/user/js/previewimage.js') }}"></script>
<script src="{{ asset('/user/js/tanggapan.js') }}"></script>
<script src="{{ asset('/user/js/inputnumber.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>

<script src="https://kit.fontawesome.com/4c48033608.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
<script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.umd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src='https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js'></script>
<script src='https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js'>
</script>
<script
    src='https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js'>
</script>


{{-- this delete image before upload --}}
<script>
    // Register plugin for preview image
    FilePond.registerPlugin(FilePondPluginImagePreview);

    const inputElement = document.querySelector('input[type="file"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement, {
        labelIdle: 'Tarik file ke sini atau <span class="filepond--label-action">Pilih file</span>',
        labelButtonRemoveItem: 'Hapus',
        labelTapToUndo: 'Tekan untuk membatalkan',
        labelTapToCancel: 'Tekan untuk membatalkan',
        labelFileProcessing: 'Mengupload',
        labelFileProcessingComplete: 'Upload selesai',
        labelFileProcessingAborted: 'Upload dibatalkan',
        labelFileProcessingError: 'Terjadi kesalahan saat upload',
        allowMultiple: true, // enable multiple file upload
    });

    FilePond.setOptions({
        server: {
            process: '/tmp/upload',
            revert: '/tmp/revert',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
    });
</script>


{{-- tooltip --}}
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
  
{{-- counter --}}
<script>
    $(document).ready(function () {
        var speed = 5; // the speed of animation in milliseconds

        $('.counter').each(function () {
            var maxCount = parseInt($(this).data('max'));
            var currentCount = 0;

            var interval = setInterval(function () {
                if (currentCount >= maxCount) {
                    clearInterval(
                        interval); // stop the interval when the count reaches the maximum value
                } else {
                    currentCount++; // increment the current count
                    $(this).text(currentCount); // update the text of the h2 element
                }
            }.bind(this), speed);
        });
    });
</script>

{{-- this accordion for help (FAQ) --}}
<script>
    const headers = document.querySelectorAll('.accordion-header');

    headers.forEach(header => {
        header.addEventListener('click', () => {
            header.classList.toggle('active');
            const content = header.nextElementSibling;
            content.style.display = content.style.display === 'block' ? 'none' : 'block';
        });
    });
</script>



{{-- modal image --}}
<script>
    $(document).ready(function () {
        $('.gambar-lampiran').click(function () {
            var src = $(this).data('src');
            $('#modalImage').attr('src', src);
        });
    });
</script>




{{-- this for button accordion show --}}
<script>
    function showAccordion(AccordionId, linkId) {
        var accordion1 = document.getElementById("accordion1");
        var accordion2 = document.getElementById("accordion2");
        var link1 = document.getElementById("nav1");
        var link2 = document.getElementById("nav2");

        if (AccordionId === "accordion1") {
            accordion1.style.display = "block";
            accordion2.style.display = "none";
            link1.classList.add("a-active");
            link2.classList.remove("a-active");
        } else if (AccordionId === "accordion2") {
            accordion2.style.display = "block";
            accordion1.style.display = "none";
            link2.classList.add("a-active");
            link1.classList.remove("a-active");
        }
    }
</script>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>


{{-- lampiran --}}
<script>
    document.getElementById("myButton").addEventListener("click", function () {
        var content = document.getElementById("myContent");
        content.style.display = (content.style.display === "block") ? "none" : "block";
    });
</script>


{{-- this API map --}}
<script>
    // you want to get it of the window global
    const providerOSM = new GeoSearch.OpenStreetMapProvider();

    //leaflet map registration
    var leafletMap = L.map('leafletMap-registration', {
        fullscreenControl: true,
        // OR
        fullscreenControl: {
            pseudoFullscreen: false // if true, fullscreen to page width and height
        },
        minZoom: 2
    }).setView([-6.9983665, 107.5636242], 13);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(leafletMap);

    let theMarker = {};


    leafletMap.on('click', function (e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);

        fetch(
                `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}&accept-language=id`
            )
            .then(response => response.json())
            .then(data => {
                // Get address from response and update HTML
                let address = data.display_name;
                document.querySelector("#address").innerHTML = address;
            })
            .catch(error => console.error(error));

        let popup = L.popup()
            .setLatLng([latitude, longitude])
            .setContent("Titik Lokasi")
            .openOn(leafletMap);

        if (theMarker != undefined) {
            leafletMap.removeLayer(theMarker);
        };

        document.querySelector("#longitude").value = longitude;
        document.querySelector("#latitude").value = latitude;


        theMarker = L.marker([latitude, longitude]).addTo(leafletMap);

    });


    const search = new GeoSearch.GeoSearchControl({
        provider: providerOSM,
        style: 'bar',
        searchLabel: 'Cari',
    });

    leafletMap.addControl(search);
</script>


<script>
    document.getElementById("btnLocation").addEventListener("click", function () {
        var content = document.getElementById("leafletMap-registration");
        content.style.display = (content.style.display === "block") ? "none" : "block";
    });
</script>