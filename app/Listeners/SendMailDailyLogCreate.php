<?php

namespace App\Listeners;

use App\Events\DailyLogCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyLogCopy;

class SendMailDailyLogCreate
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
     * @param  \App\Events\DailyLogCreated  $event
     * @return void
     */
    public function handle(DailyLogCreated $event)
    {
        //Log::info($event->log());
        Mail::to('test@test')->send(new DailyLogCopy());
    }
}
