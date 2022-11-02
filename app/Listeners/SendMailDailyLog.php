<?php

namespace App\Listeners;

use App\Events\DailyLogStore;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMailDailyLog
{
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
     * @param  \App\Events\DailyLogStore  $event
     * @return void
     */
    public function handle(DailyLogStore $event)
    {
        //
    }
}
