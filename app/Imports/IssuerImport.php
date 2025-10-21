<?php

namespace App\Imports;


use App\Models\Issuer;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;


class SecurityImport implements ToCollection, WithValidation, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Issuer::create([

                'name' => $row['name'],
                'code' => $row['code'],

            ]);
        }
    }



    public function rules(): array
    {

        return [

            'name' => [
                'required',
                Rule::unique('issuers', 'name'),

            ],
            'code' => [
                'required',

            ],


        ];
    }
}
