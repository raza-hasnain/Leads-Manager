@extends('layouts.installer')

@section('content')
<div class="page-wrapper">
            <div class="content-wrapper">
                <div class="container"> 
                    <!-- begin of row -->
                    <div class="row"> 
                        <div class="box px-sm-15"> 
                            <div class="page-content">
                                <div class="outer-container">
                                    <div class="box-inner">
                                        <div class="inner">
                                            <img src="{{ asset('public/admin_layout/installer/img/001-trash-bin.png')}}" alt="">
                                            <h4>Please delete installer to run your application</h4>
                                        </div>
                                        <div class="text-right">
                                            <a href="{{ route('installer.remove_file') }}" class="btn btn-danger btn-block">Delete Now</a>
                                        </div>
                                        <div class="text-center bordered-area">
                                            <span>or</span>
                                        </div>
                                    </div>                            
                                    <div class="instruction">
                                        <h5 class="no-text">If you Don't have permission to delete the installer !</h5>
                                        <p class="text-success">Please go through the following steps.</p>
                                        <ul class="step-list">
                                            <li><span>1.</span> Go to the root folder of your server where placed all the files. ex: public_html/</li>
                                            <li><span>2.</span> Delete the install folder.</li>
                                            <li><span>3.</span> Then refresh this page or click the button below.</li>
                                        </ul>
                                        <div class="text-right">
                                            <a href="{{ route('installer.remove_file') }}" class="btn btn-refresh">Refresh</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
          @endsection