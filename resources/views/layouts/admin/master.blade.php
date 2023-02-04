
<!DOCTYPE html>
<html lang="en">
  @include('includes.admin.head')
  <body>
    <!-- Loader starts-->
    @include('includes.admin.loader')
    <!-- Loader ends-->
    <!-- page-wrapper Start       -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      @include('includes.admin.navbar')
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
        @include('includes.admin.sidebar')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <!-- Container-fluid starts-->
          @yield('content')
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        @include('includes.admin.footer')
      </div>
    </div>
    @include('includes.admin.script')
    
  </body>
</html>