{!!Form::open(['route'=>array('leads.add_summary',$leadid),'id'=>'lead-update-form']) !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('leads.add_summary')</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    @requiredInfo
    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <div class="skin-square">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="i-check">
                            <input id="contact_check" type="checkbox" >
                            <label for="square-checkbox-1" class="label_length" maxlength="20">@lang('leads.contacted')</label>
                        </div> 
                    </div>
                </div>     
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row d-none" id="date_time">
        <div class="col-lg-12">
            <label for="example-datetime-local-input" class="col-form-label">@lang('layout.date_and_time')</label>
            <input type="text" id="datetimepick" class="form-control datetimepick" name="last_contacted" type="datetime-local"  id="example-datetime-local-input" onkeypress="return false;" onkeyup="return false;"  ondrop="return false;" onpaste="return false;">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <label class="">
                @lang('layout.summary')
            </label>
            <textarea rows="2" id="summary" class="form-control" name="summary" autocomplete="off"></textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="submitEditLead" class="btn btn-base lead_id-{{clean($leadid)}}">@lang('layout.update')</button>
</div>

<script src="{{asset('public/admin_layout/js/Modules/Leads/summary.js')}}?v={{ $version }}"></script>  