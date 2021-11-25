<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'is_primary'            => $this->is_primary,
            'company_id'            => $this->company_id,
            'address_line_1'        => $this->address_line_1,
            'address_line_2'        => $this->address_line_2,
            'city'                  => $this->city,
            'state_province_county' => $this->state_province_county,
            'country'               => $this->country,
            'zip_post_code'         => $this->zip_post_code,
            'other_address_details' => $this->other_address_details,
        ];
    }
}
