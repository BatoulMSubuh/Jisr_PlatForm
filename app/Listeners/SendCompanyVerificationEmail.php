<?php

namespace App\Listeners;

use App\Events\CompanyVerified;
use App\Models\Notification;
use App\Notifications\CompanyVerifiedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCompanyVerificationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CompanyVerified $event): void
    {
    Notification::send($event->user, new CompanyVerifiedNotification($event->company));

    }
}
