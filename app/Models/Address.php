<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'is_primary',
        'address_line_1',
        'address_line_2',
        'city',
        'state_province_county',
        'country',
        'zip_post_code',
        'other_address_details',
    ];

    protected $casts = [
      'is_primary' => 'boolean'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
