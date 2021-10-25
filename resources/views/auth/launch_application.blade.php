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
                                            <img src="{{ asset('public/admin_layout/installer/img/004-startup.png')}}" alt="">
                                            <div class="p_content">
                                                <h5>installer successfully deleted</h5>
                                                <p>please click the button to launch application.</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <a href="{{route('index')}}" class="btn btn-success btn-right">Launch Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div> 
                
            </div>
        </div>
    @endsection