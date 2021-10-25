<?php

namespace Modules\Lead\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $this->email = $this->customer_lead;
        $validation_array = [
            'lead_status_id' => 'required',
            'lead_source_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'nullable',
            'assigned_to' => 'required',
            'country_id'=>'required|numeric',
            'email' => 'required|email|unique:leads',
            'company' => 'nullable',
        ];
        if($this->isMethod('post')){
           if($this->country_id !=0 ){
               $country_id=$this->country_id;
                $phone_no_validation=\App\Models\Country::Where('id',$country_id)->first();
                if ($phone_no_validation->min_digits !== null || $phone_no_validation->max_digits !== null) {
                        $min_digits=$phone_no_validation->min_digits;
                        $max_digits=$phone_no_validation->max_digits;
                        $validation_array['phone']='required|numeric|digits_between:'.$min_digits.','.$max_digits;
                }
                else{
                    $min_digits = 8;
                    $max_digits = 12;
                    $validation_array['phone']='required|numeric|digits_between:'.$min_digits.','.$max_digits;
                }
            }
            return $validation_array;

        }else 
            return [];
    }
}
