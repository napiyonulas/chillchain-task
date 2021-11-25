<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'name'                              => 'required|string|max:255',
            'contacts.*.name'                   => 'required|string|max:255',
            'contacts.*.phone'                  => 'required|phone',
            'contacts.*.phone_country'          => 'required_with:phone|exists:countries,code',
            'contacts.*.is_primary'             => 'required|boolean',
            'addresses.*.is_primary'            => 'required|boolean|unique:addresses,is_primary,'.$this->is_primary.',0,company_id,'.$this->company_id,
            'addresses.*.address_line_1'        => 'required|string',
            'addresses.*.address_line_2'        => 'string',
            'addresses.*.city'                  => 'required|string',
            'addresses.*.state_province_county' => 'required|string',
            'addresses.*.country'               => 'required|string|exists:countries,name',
            'addresses.*.zip_post_code'         => 'required|string',
            'addresses.*.other_address_details' => 'min:3|max:1000',
        ];
    }
}
