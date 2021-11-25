<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ContactResource;
use App\Http\Resources\AddressResource;

class CompanyResource extends JsonResource
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
            'id'   => $this->id,
            'name' => $this->name,
            'primary_contact' =>  $this->primary_contact,
            'primary_address' =>  $this->primary_address,
            'contacts' => ContactResource::collection($this->contacts),
            'addresses' => AddressResource::collection($this->addresses),
        ];
    }
}
