<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_id'                        => 'required|exists:companies,id',
            'addresses.*.is_primary'            => 'required|boolean',
            'addresses.*.address_line_1'        => 'required|string',
            'addresses.*.address_line_2'        => 'nullable|string',
            'addresses.*.city'                  => 'required|string',
            'addresses.*.state_province_county' => 'required|string',
            'addresses.*.country'               => 'required|string|exists:countries,name',
            'addresses.*.zip_post_code'         => 'required|string',
            'addresses.*.other_address_details' => 'nullable|min:3|max:1000',
        ];
    }
}
