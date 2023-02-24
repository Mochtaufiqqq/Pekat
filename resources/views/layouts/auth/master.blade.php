<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="/images/lapekat2.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/images/lapekat2.ico" type="image/x-icon">
    <title>LAPEKAT | @yield('title')</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="/admins/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="/admins/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="/admins/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="/admins/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="/admins/css/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="/admins/css/sweetalert2.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="/admins/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="/admins/css/style.css">
    <link id="color" rel="stylesheet" href="/admins/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="/admins/css/responsive.css">
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    @yield('content')
    <!-- page-wrapper end-->
    <!-- latest jquery-->
    <script src="/admins/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="/admins/js/icons/feather-icon/feather.min.js"></script>
    <script src="/admins/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="/admins/js/sidebar-menu.js"></script>
    <script src="/admins/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="/admins/js/bootstrap/popper.min.js"></script>
    <script src="/admins/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <script src="/admins/js/sweet-alert/sweetalert.min.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="/admins/js/script.js"></script>
    <script>
        document.getElementById("inputNumber").addEventListener("keypress", function (event) {
            if (event.key === "e") {
                event.preventDefault();
            }
        });
    </script>
    <!-- login js-->
    <!-- Plugin used-->
</body>

</html>