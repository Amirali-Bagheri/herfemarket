<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // NewUserCreated::class => [
        //     NotifyToUsersNewRegistered::class
        // SendRegistrationConfirmationEmail::class,
        // SendWellcomeRegisterEmail::class
        // ],
        // UserHasBegunResetProcess::class => [
        //     SendResetCodeEmail::class,
        // ],
        // UserWasUpdated::class => [
        //     FlushesSidebarCache::class,
        // ],
        // RoleWasUpdated::class => [
        //     FlushesSidebarCache::class,
        // ],
    ];
}
