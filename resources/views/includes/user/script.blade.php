<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>

<script src="https://kit.fontawesome.com/4c48033608.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
<script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.umd.js"></script>


{{-- <script>
    $(document).ready(function () {
        $('a[data-id_pengaduan]').click(function (e) {
            e.preventDefault();
            var id_pengaduan = $(this).data('id_pengaduan');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/pengaduan/me/delete/' + id_pengaduan,
                        data: {
                            '_token': "{{ csrf_token() }}",
'id_pengaduan': id_pengaduan
},
success: function (data) {
Swal.fire(
'Deleted!',
'Your file has been deleted.',
'success'
);
window.location.reload();
}
});
}
});
});
});
</script> --}}



{{-- <script>
    // profile-photo.js

    document.getElementById("profile-photo-input").addEventListener("change", function () {
        document.getElementById("profile-photo-form").submit();
    });
</script> --}}

<script>
    function showForm(formId) {
        var form1 = document.getElementById("form1");
        var form2 = document.getElementById("form2");
        if (formId === "form1") {
            form1.style.display = "block";
            form2.style.display = "none";
        } else if (formId === "form2") {
            form2.style.display = "block";
            form1.style.display = "none";
        }
    }
</script>


{{-- <script>
        document.getElementById("profile-photo-input").addEventListener("change", function() {
        document.getElementById("profile-photo-form").submit();
    }); 
  </script> --}}


{{-- input number --}}
<script>
    document.getElementById("inputNumber").addEventListener("keypress", function (event) {
        if (event.key === "e") {
            event.preventDefault();
        }
    });
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

<script>
    const tabs = document.querySelectorAll(".tab");
    const forms = document.querySelectorAll(".form");

    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            const id = this.id.replace("tab", "");
            tabs.forEach(tab => {
                tab.classList.remove("tab-active");
            });
            this.classList.add("tab-active");
            contents.forEach(content => {
                content.style.display = "none";
            });
            document.getElementById("form" + id).style.display = "block";
        });
    });

    document.getElementById("tab1").classList.add("tab-active");
    document.getElementById("content1").style.display = "block";
</script>

{{-- <script>
    document.getElementById("showInputButton").addEventListener("click", function() {
  const input = document.getElementById("image");
  if (input.style.display === "none") {
    input.style.display = "block";
  } else {
    input.style.display = "none";
  }
});

</script> --}}


<script>
    // listen for scroll event
    window.addEventListener("scroll", function () {
        let btn = document.getElementById("scroll-to-top-btn");
        // show or hide the button based on the page scroll position
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            btn.style.display = "block";
        } else {
            btn.style.display = "none";
        }
    });

    // handle click event
    document.getElementById("scroll-to-top-btn").addEventListener("click", function () {
        // smoothly scroll to the top of the page
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
</script>

<script>
    $('.gambar-lampiran').click(function () {
        var imageSrc = $(this).attr('src');
        $('#imagePreview').attr('src', imageSrc);
    });
</script>

{{-- <script>
    $(document).ready(function(){
    $('.menu-right').click(function(){
        $('.menu-right').removeClass('active');
        $(this).addClass('active');
    });
});
</script> --}}

<script>
    const buttons = document.querySelectorAll(".myTanggapan");
    const contents = document.querySelectorAll(".tanggapanContent");

    buttons.forEach((button, index) => {
        button.addEventListener("click", function () {
            const content = contents[index];
            content.style.display = content.style.display === "block" ? "none" : "block";
        });
    });
</script>


<script>
    document.getElementById("myButton").addEventListener("click", function () {
        var content = document.getElementById("myContent");
        content.style.display = (content.style.display === "block") ? "none" : "block";
    });
</script>

<script>
    var count = 0;

    window.addEventListener("scroll", function () {
        var scrollPosition = window.pageYOffset;
        if (scrollPosition > count) {
            count++;
            document.getElementById("count").innerHTML = count;
        }
    });
</script>



<script>
    // you want to get it of the window global
    const providerOSM = new GeoSearch.OpenStreetMapProvider();

    //leaflet map
    var leafletMap = L.map('leafletMap-registration', {
        fullscreenControl: true,
        // OR
        fullscreenControl: {
            pseudoFullscreen: false // if true, fullscreen to page width and height
        },
        minZoom: 2
    }).setView([0, 0], 2);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(leafletMap);

    let theMarker = {};

    

    leafletMap.on('click', function (e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);

        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`)
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