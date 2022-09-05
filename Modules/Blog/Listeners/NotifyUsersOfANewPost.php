<?php

namespace Modules\Blog\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Blog\Listeners\Events\PostWasCreated;

class NotifyUsersOfANewPost implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PostWasCreated $event
     * @return void
     */
    public function handle(PostWasCreated $event)
    {
        //
    }
}
