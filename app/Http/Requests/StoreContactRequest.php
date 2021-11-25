<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'company_id'                => 'required|exists:companies,id',
            'contacts.*.name'           => 'required|string|max:255',
            'contacts.*.phone'          => 'required|phone',
            'contacts.*.phone_country'  => 'required_with:phone|exists:countries,code',
            'contacts.*.is_primary'     => 'required|boolean',
        ];
    }
}
