<!DOCTYPE html>
<html lang="en">
    <head>
		@include('layouts.admin.meta')
		@include('layouts.admin.title')
		@include('layouts.admin.admin_css')
        @yield('css')
        @include('layouts.admin.admin_custom_css')
    </head>
    <body class="index3-body">
       <!-- Preloader -->
        <div class="preloader"></div>
       
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Header Area -->
            @include('layouts.admin.header')
			<!-- /Header Area-->
            <!-- Sidebar Area -->
            @include('layouts.admin.leftnav')
            <!-- /sidebar Area-->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper px-4 content-wrapper-active">
                <!-- Main content -->
                @yield('content')
				<!-- /content -->
            </div><!-- /content-wrapper -->
			@include('layouts.admin.footer')
        </div> <!-- /wrapper -->
        <div class="overlay"></div>
        <div class="chat_box" id="chatbox">
                         
                    </div> 
<div class="modal fade modal-success" id="ajax-modal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
    <div  class="modal-dialog modal-lg">
        <div class="modal-content modal-margin" id="modal-ajaxview">
        </div>
    </div>
</div> 
		@include('layouts.admin.admin_js')
		@yield('js')
    </body>
</html>