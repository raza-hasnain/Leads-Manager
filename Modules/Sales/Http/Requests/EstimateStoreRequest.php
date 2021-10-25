<?php

namespace Modules\Sales\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstimateStoreRequest extends FormRequest
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
            'title' => 'required',
            'status_id' => 'required',
            'module_id' => 'required',
            'module_member_id' => 'required',
            'open_date' => 'required',
            'expiry_date' => 'required',
            'email' => 'required',
            'country_id' => 'required',
            'description.*' => 'required|not_regex:/(\s*)<script(?![ \t\r\n]+type\s*=\s*"\s*text\/x\-template\s*").*?(\b[^>]*?>)([\s\S]*?)<\/script>(\s*)/',
            'long_description.*' => 'required|not_regex:/(\s*)<script(?![ \t\r\n]+type\s*=\s*"\s*text\/x\-template\s*").*?(\b[^>]*?>)([\s\S]*?)<\/script>(\s*)/',
            'quantity.*' => 'required',
            'rate.*' => 'required',
        ];

        if($this->isMethod('post')){
            if($request->has('description')){
            return $validation_array;
            }
             else{
                return response()->json(['errors'=> ['items'=>  __('layout.no_items_add')]], 422);exit;
            }
        }else {
            return [];
        }
    }
}
