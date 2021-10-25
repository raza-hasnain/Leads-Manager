<?php

namespace Modules\Sales\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
{
    

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validation_array = [
            'name' => 'required',
            'rate' => 'required',
            'item_category_id' => 'required',
        ];

        if($this->isMethod('post')){
            return $validation_array;
        }else {
            return [];
        }
    }
}
