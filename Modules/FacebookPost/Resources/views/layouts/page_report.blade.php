<!-- Facebook Page Reposrt Area -->
<div class="card small-card" data-sortable="true">
    <div class="card-header">
        <div class="card-title">
            <span><i class=ti-facebook></i></span>@lang('facebookpost.report')
        </div>
    </div>
    <div class="card-block">
    	<div class="form-group m-form__group row px-2">
    		  <div class="col-lg-6 pt-2">
                        <label>
                            @lang('layout.start') 
                        </label>
                        <input class="date_value form-control m-input m-input--solid" type="text" name="open_date" id="start_date" value="" />
                    </div>
                    <div class="col-lg-6 pt-2">
                        <label>
                            @lang('layout.end') 
                        </label>
                        <input class="date_value form-control m-input m-input--solid" type="text" name="expiry_date" value="" id="end_date"/>
                    </div>
                </div>
                <div class="row px-2" id="facebookReport">
                	
                </div>
    </div>
</div>
                

<!-- End Report Area -->
