<?php

namespace App\Imports;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Modules\Customer\Entities\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CustomerImport implements ToModel,WithHeadingRow,WithValidation
{
	/**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
        	'customer_id' => generateRandomStr(),
            'name'     => $row['name'],
            'email'    => $row['email'], 
            'phone'    => $row['phone'],
            'country_id' => getcountry($row['country_name'],$row['country_code']),
            'company'    => $row['company'], 
            'vat_number' => $row['vat_number'], 
            'website'    => $row['website'], 
            'address'    => $row['address'], 
            'city'    => $row['city'], 
            'zip_code'    => $row['zip_code'],
            'created_by' => Auth::id(),
        ]);
    }
    public function rules(): array
    {
    	$validation_array = [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:customers',
        ];
        return $validation_array;
    }
    public function headingRow(): int
    {
        return 1;
    }
}
