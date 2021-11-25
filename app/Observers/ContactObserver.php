<?php

namespace App\Observers;

use App\Models\Contact;

class ContactObserver
{
    /**
     * Handle the Contact "creating" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function creating(Contact $contact)
    {
        if ($contact->company()->first()->primary_contact->count() > 0 && $contact->is_primary === true){
            $contact->company()->first()->contacts()->update(['is_primary' => false]);
        }elseif ($contact->company()->first()->primary_contact->count() < 1 && $contact->is_primary === false){
            $contact->is_primary = true;
        }
    }
    /**
     * Handle the Contact "updating" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function updating(Contact $contact)
    {
        if ($contact->company()->first()->primary_contact->count() > 0 && $contact->is_primary === true){
            $contact->company()->first()->contacts()->update(['is_primary' => false]);
        }elseif ($contact->company()->first()->primary_contact->count() < 1 && $contact->is_primary === false){
            $contact->is_primary = true;
        }
    }
     /**
     * Handle the Contact "deleting" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return boolean
     */
    public function deleting(Contact $contact)
    {
        if ($contact->is_primary){
            return false;
        }
    }
}
