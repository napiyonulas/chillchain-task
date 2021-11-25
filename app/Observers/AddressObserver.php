<?php

namespace App\Observers;

use App\Models\Address;

class AddressObserver
{
    /**
     * Handle the Address "creating" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function creating(Address $address)
    {
        if ($address->company()->first()->primary_address->count() > 0 && $address->is_primary === true){
            $address->company()->first()->addresses()->update(['is_primary' => false]);
        }elseif ($address->company()->first()->primary_address->count() < 1 && $address->is_primary === false){
            $address->is_primary = true;
        }
    }
    /**
     * Handle the Address "updating" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function updating(Address $address)
    {
        if ($address->company()->first()->primary_address->count() > 0 && $address->is_primary === true){
            $address->company()->first()->addresses()->update(['is_primary' => false]);
        }elseif ($address->company()->first()->primary_address->count() < 1 && $address->is_primary === false){
            $address->is_primary = true;
        }
    }

    /**
     * Handle the Address "deleting" event.
     *
     * @param  \App\Models\Address  $address
     * @return boolean
     */
    public function deleting(Address $address)
    {
        if ($address->is_primary === true){
            return false;
        }
    }
}
