{!!Form::open(['route'=>array('customer.import_file',$file_type),'id'=>'customer-import-form','enctype' => 'multipart/form-data']) !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('customers.import_customer')</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    @requiredInfo
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            @if($file_type == 1)
            <label for="file-upload" class="custom-file-upload btn btn-base btn-md">
                <i class="fas fa-file-excel mr-1"></i>@lang('layout.excel')
            </label>
            @else
            <label for="file-upload" class="custom-file-upload btn btn-base btn-md">
                <i class="fas fa-file-csv"></i>@lang('layout.csv')
            </label>
            @endif
            <input id="file-upload" class="file_upload" name=import_file type="file" multiple="multiple"/>
            <span id="filename"></span>
        </div>
        <div class="col-lg-12 row pt-3">
            <div class="col-lg-6">
                <b>@lang('leads.please_follow_the_instraction')</b>
                <ul>
                    <li class="text-danger">@lang('layout.name_must_not_empty') @required</li>
                    <li class="text-danger">@lang('layout.Phone_must_not_empty') @required</li>
                    <li class="text-danger">@lang('layout.Email_must_not_empty_and_can_not_be_duplicated') @required</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <a href="{{route('customer.download',$file_type)}}" ><button type="button" class="btn btn-success float-right " >@lang('layout.download_demo')</button></a>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer import_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="import_file" class="btn btn-base">@lang('layout.save')</button>
</div>
{!! Form::close() !!}
<script src="{{asset('public/admin_layout/js/Modules/Customers/import_file.js')}}?v={{ $version }}"></script>