<?php
use App\Events\LoginOtpRequested;
use App\Events\PasswordResetOtpRequested;
use App\Events\UserRegistrationFailed;
use App\Events\UserRegistered;

use App\Listeners\SendLoginOtpListener;
use App\Listeners\DeleteUploadedImage;
use App\Listeners\SendWelcomeEmailListener;
use App\Listeners\AssignDefaultRoleListener;
use App\Listeners\SendResetOtpListener;
use App\Listeners\SendWelcomeNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        LoginOtpRequested::class => [
            SendLoginOtpListener::class,
        ],

        UserRegistrationFailed::class => [
            DeleteUploadedImage::class,
        ],

        UserRegistered::class => [
            SendWelcomeNotification::class,
        ],

         PasswordResetOtpRequested::class => [
            SendResetOtpListener::class,
        ],

    ];

    public function boot(): void
    {
        parent::boot();
    }
}