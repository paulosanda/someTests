<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\DailyLog;

class SaveRandomQuote implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $date;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $date)
    {
        $this->user = $user;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DailyLog::create([
            'user_id' => $this->user->id,
            'day' => $this->date,
            'log'     => 'Friends are those rare people who ask how we are and then wait to hear the answer.',
        ]);
    }
}
