<?php

namespace App\Imports;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Modules\Sales\Entities\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ItemImport implements ToModel,WithHeadingRow,WithValidation
{
	/**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Item([
        	'item_id' => generateRandomStr(),
            'name'=> $row['name'],
            'description'    => $row['description'],
            'rate'    => $row['rate'],
            'unit'    => $row['unit'],
            'tax_id_1'    => $row['tax_id_1'],
            'tax_id_2'    => $row['tax_id_2'],
            'created_by' => Auth::id(),
        ]);
    }
    public function rules(): array
    {
    	$validation_array = [
            'name' => 'required',
            'rate' => 'required',
        ];
        return $validation_array;
    }
    public function headingRow(): int
    {
        return 1;
    }
}
