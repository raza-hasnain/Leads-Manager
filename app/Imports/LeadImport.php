<?php

namespace App\Imports;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Modules\Lead\Entities\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class LeadImport implements ToModel,WithHeadingRow,WithValidation
{
	/**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Lead([
        	'lead_id' => generateRandomStr(),
            'first_name'=> $row['first_name'],
            'last_name'     => $row['last_name'],
            'email'    => $row['email'], 
            'phone'    => $row['phone'],
            'social_id_link'    => $row['social_id'],
            'country_id' => getcountry($row['country_name'],$row['country_code']),
            'company'    => $row['company'],  
            'position'    => $row['position'],  
            'website'    => $row['website'], 
            'address'    => $row['address'], 
            'city'    => $row['city'], 
            'state'    => $row['state'], 
            'zip_code'    => $row['zip_code'],
            'description'    => $row['description'],
            'summary'    => $row['summary'],
            'created_by' => Auth::id(),
        ]);
    }
    public function rules(): array
    {
    	$validation_array = [
            'first_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:leads',
        ];
        return $validation_array;
    }
    public function headingRow(): int
    {
        return 1;
    }
}
