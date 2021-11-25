<?php

namespace App\Observers;

use App\Models\Company;
use App\Models\Contact;

class CompanyObserver
{
    /**
     * Handle the Company "deleting" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function deleting(Company $company)
    {
        $company->contacts()->delete();
        $company->addresses()->delete();
    }
}
