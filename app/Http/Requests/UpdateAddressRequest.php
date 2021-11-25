<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'id'                    => 'required|exists:addresses,id',
            'is_primary'            => 'required|boolean',
            'address_line_1'        => 'required|string',
            'address_line_2'        => 'nullable|string',
            'city'                  => 'required|string',
            'state_province_county' => 'required|string',
            'country'               => 'required|string|exists:countries,name',
            'zip_post_code'         => 'required|string',
            'other_address_details' => 'nullable|min:3|max:1000',
        ];
    }
}
