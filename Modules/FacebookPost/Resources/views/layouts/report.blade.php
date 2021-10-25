<div class="col-lg-12 py-2 ">
                        <div class="card" >
                         <div class="card-header bg-white">
                            <div class="card-title">
                                <div class="row">
                               <span class="col-8 text-left" > @lang('facebookpost.convert_lead') </span>
                                 <span class="col-4 text-right" > {{clean($leadCount)}}/{{$count}}</span>
                                 </div>
                                
                                
                                <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {{clean($leadCount_per)}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </div>

                        </div>
                        </div>

                        </div>
                        <div class="col-lg-12 py-2 ">
                        <div class="card" >
                        <div class="card-header bg-white">
                            <div class="card-title">
                                <div class="row">
                               <span class="col-8 text-left" > @lang('facebookpost.convert_customer') </span>
                                 <span class="col-4 text-right" > {{clean($customerCount)}}/{{$count}}</span>
                                 </div>
                                
                                
                                <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {{clean($customerCount_per)}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </div>

                        </div>
                        
                        </div>
                    </div>
                    <div class="col-lg-12 py-2 ">
                        <div class="card" >
                         <div class="card-header bg-white">
                            <div class="card-title">
                                   <div class="row">
                               <span class="col-8 text-left" > @lang('facebookpost.total_link_post') </span>
                                 <span class="col-4 text-right" > {{clean($count-$media)}}/{{clean($count)}}</span>
                                 </div>
                                
                                
                                <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {{100-$media_per}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                     <div class="col-lg-12 py-2 ">
                        <div class="card" >
                         <div class="card-header bg-white">
                            <div class="card-title">
                                <div class="row">
                               <span class="col-8 text-left" > @lang('facebookpost.total_media_post') </span>
                                 <span class="col-4 text-right" > {{$media}}/{{$count}}</span>
                                 </div>
                                
                                
                                <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {{$media_per}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </div>

                        </div>
                        
                        </div>
                    </div>