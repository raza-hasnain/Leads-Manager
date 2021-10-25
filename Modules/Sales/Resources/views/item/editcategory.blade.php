{!!Form::open(['route'=>array('items.editcategory',$item->id),'id'=>'itemcategory-edit-form']) !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('sales.new_items')</h5>
   <a href="#"  data-dismiss="modal" aria-label="close">&times;</a>
</div>
<div class="modal-body">
    @requiredInfo
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label>
                @lang('layout.name') @required
            </label>
            <input type="text" name="name" class="form-control m-input m-input--solid" placeholder="@lang('layout.name')" value="{{clean($item->name)}}">
        </div>
        <div class="col-lg-6">
            <label>
                @lang('sales.category') 
            </label>
            <select name="parent_id" class="form-control">
                <option  value="">@lang('layout.select')</option>
                @foreach($categories as $category) @required
                    <option  value="{{ clean($category->id) }}" @if($item->parent_id==$category->id) selected @endif>{{ clean($category->name) }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="modal-footer edit_category">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" class="btn btn-success" id="submit_editcategory">@lang('layout.save')</button>
</div>
{!! Form::close() !!}
<script src="{{asset('public/admin_layout/js/Modules/Item/edit_category.js')}}?v={{ $version }}"></script>