<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'phone',
        'phone_country',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean'
    ];
    public function company(){
        return $this->belongsTo(Company::class,'company_id');
    }



}
