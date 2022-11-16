<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\DailyLog;
use Illuminate\Queue\Middleware\RateLimited;

class SaveRandomQuote implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 0;

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

    public function middleware()
    {
        return [
            new RateLimited('notifications'),
        ];
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
            'log'     => 'An unexamined life is not worth living.',
        ]);
    }
}
