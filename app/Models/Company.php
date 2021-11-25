<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;
use App\Models\Address;


class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $appends = [
      'primary_contact',
      'primary_address'
    ];

    public function contacts(){
        return $this->hasMany(Contact::class);
    }
    public function addresses(){
        return $this->hasMany(Address::class);
    }


    public function getPrimaryContactAttribute(){
        return $contacts = $this->contacts()->select('name','phone')->where('is_primary', '=',1)->get();
    }
    public function getPrimaryAddressAttribute(){
        return $contacts = $this->addresses()->select('address_line_1')->where('is_primary', '=',1)->get();
    }

}
