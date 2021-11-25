<?php

namespace App\Providers;

use App\Models\Address;
use App\Models\Company;
use App\Models\Contact;
use App\Observers\AddressObserver;
use App\Observers\CompanyObserver;
use App\Observers\ContactObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Company::observe(CompanyObserver::class);
        Contact::observe(ContactObserver::class);
        Address::observe(AddressObserver::class);
    }
}
