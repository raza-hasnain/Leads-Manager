@extends('layouts.admin.admin_layout')
@section('css')
         <!-- START PAGE LABEL PLUGINS --> 
       
        <link rel="stylesheet" href="{{ asset('public/admin_layout/plugins/chartjs-bar-chart/Chart.min.css')}}?v={{ $version }}">
@endsection
@section('content')
         <div class="content">
                  <div class="row pb-3 ">
                    <div class="col-lg-3 ">
                        <div class="card" >
                         <div class="card-header bg-white">
                            <div class="card-title">
                                   <div class="row home-card">
                               <span class="col-8 text-left" > @lang('layout.converted_customer') </span>
                                 <span class="col-4 text-right" id="converted_customer"> 0/0</span>
                                 </div>
                                
                                
                                <div class="progress">
                              <div class="progress-bar" role="progressbar" id="converted_customer_progress"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                     <div class="col-lg-3 ">
                        <div class="card" >
                         <div class="card-header bg-white">
                            <div class="card-title">
                                <div class="row home-card">
                               <span class="col-8 text-left" > @lang('layout.Facebook_Leads') </span>
                                 <span class="col-4 text-right" id="facebook_lead" > 0/0</span>
                                 </div>
                                
                                
                                <div class="progress">
                              <div class="progress-bar" role="progressbar" id="facebook_lead_progress" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </div>

                        </div>
                        
                        </div>
                    </div>
                     <div class="col-lg-3 ">
                        <div class="card" >
                         <div class="card-header bg-white">
                            <div class="card-title">
                                 <div class="row home-card">
                               <span class="col-8 text-left" > @lang('layout.Estimates_accept') </span>
                                 <span class="col-4 text-right" id="estimates_count" > 0/0</span>
                                 </div>
                                
                               
                                <div class="progress">
                              <div class="progress-bar" role="progressbar" id="estimates_count_progress" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </div>
                        </div>
                         
                        </div>
                    </div>
                     <div class="col-lg-3 ">
                        <div class="card" >
                         <div class="card-header bg-white">
                            <div class="card-title">
                                <div class="row home-card">
                               <span class="col-8 text-left customers" > @lang('layout.facebook_Customer') </span>
                                 <span class="col-4 text-right" id="facebook_Customer" > 0/0</span>
                                 </div>
                                <div class="progress">
                              <div class="progress-bar" role="progressbar" id="facebook_Customer_progress" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </div>
                        </div>
                         
                        </div>
                    </div>
                </div>
                   <div class="row">
                    <div class="col-lg-4">
                    <!--Doughut chart2-->
                    <div class="card lobicard" data-sortable="true">
                    
                        <div class="card-header">
                            <div class="card-title bg-white">
                                @lang('layout.customer__status_statistics')
                            </div>
                        </div>
                        <div class="card-block p-3 basic-forms">
                          <canvas id="doughutChart" height="200"></canvas>
                        </div>
                    </div>
                    
                    <!-- /Doughut chart2-->
                  </div>

                  <div class="col-lg-8">
                    <!-- Line chart -->
                    <div class="card lobicard" data-sortable="true">
                        <div class="card-header">
                            <div class="card-title">
                                @lang('layout.customer_statistics_lastmonth')
                            </div>
                        </div>
                        <div class="card-block p-3 basic-forms">
                          <canvas id="lineChart" height="92"></canvas>
                        </div>
                    </div>
                    <!-- /Line chart -->
                  </div>
                        <div class="col-lg-4">
                          <div class="card lobicard small-card" data-sortable="true">
                              <div class="card-header">
                                  <span><i class=ti-stats-up></i></span>
                                  <div class="card-title">
                                        @lang('task.recent_activities')
                                  </div>
                              </div>
                              <div class="card-block p-3 pl-5">
                                   <ul class="activity-list" id="activity-list">
                                        
                                    </ul>
                              </div>
                          </div>
                      </div>
                         <div class="col-lg-8">
                    <!-- Line chart -->
                    <div class="row col-lg-12 p-0 m-0">
                    <div class="card lobicard col-lg-6" data-sortable="true">
                        <div class="card-header">
                            <div class="card-title">
                                @lang('layout.invoice_overview')
                            </div>
                        </div>
                        <div class="card-block p-3 basic-forms task-list">
                          <canvas id="doughutChart2" height="200"></canvas>
                        </div>
                    </div>
                     <div class="card lobicard col-lg-6" data-sortable="true">
                        <div class="card-header">
                            <div class="card-title">
                                @lang('task.task_list')
                            </div>
                        </div>
                        <div class="card-block p-3 basic-forms task-list" id="task">
                        
                        </div>
                    </div>
                    </div>
                    <!-- /Line chart -->
                     
                    <div class="card lobicard col-lg-12" data-sortable="true">
                        <div class="card-header">
                            <div class="card-title">
                                @lang('layout.lead_overview_lastmonth')
                            </div>
                        </div>
                        <div class="card-block p-3 basic-forms">
                          <canvas id="lineChart3" height="78"></canvas>
                        </div>
                    </div>
                    <!-- /Line chart -->
                  </div>

                  </div>
                  
                </div>
@endsection

@section('js')

     
            <!--Page for chart js-->
      <script src="{{asset('public/admin_layout/plugins/chartJs/Chart.min.js')}}?v={{ $version }}"></script>
    
        <script src="{{asset('public/admin_layout/js/home.js')}}?v={{ $version }}"></script>

         
@endsection