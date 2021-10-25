{!!Form::open(['route'=>array('items.edit',$item->id),'id'=>'item-edit-form']) !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('sales.edit_item')</h5>
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
            <label class="">
                @lang('sales.rate') @required
            </label>
            <input type="number" name="rate" class="form-control m-input m-input--solid" placeholder="@lang('sales.rate')" value="{{clean($item->rate)}}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <label class="">
                @lang('layout.description')
            </label>
            <textarea name="description" class="form-control m-input m-input--solid" placeholder="@lang('layout.description')">{{clean($item->description)}}</textarea>
        </div>
    </div>
    <div class="form-group m-form__group row">
     
        <div class="col-lg-12">
            <label>
                @lang('sales.category') @required
            </label>
            <select name="item_category_id" class="form-control">
                @foreach($categories as $category) @required
                    <option @if($item->item_category_id == $category->id) selected @endif  value="{{ clean($category->id) }}">{{ clean($category->name) }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="modal-footer edit_item">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" class="btn btn-success" id="submit_edititem">@lang('layout.save')</button>
</div>
{!! Form::close() !!}

<script src="{{asset('public/admin_layout/js/Modules/Item/edit.js')}}?v={{ $version }}"></script>