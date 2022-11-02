<?php

namespace Tests\Exam;

use App\Jobs\SaveRandomQuote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * Job Rate Limit Test
 * - On this test we will check if you know how to:
 *
 * 1. Define a rate limit for the queue, for user, by a period
 * 2. Attach a middleware on the job that you want to limit its execution
 *
 * @package Tests\Feature\Exam
 */
class h_JobRateLimitTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        config(['queue.default' => 'database']);

        $this->user = User::factory()->create();
    }

    /**
     * Create a job that will request for a date and a user
     * It should be executed daily per user
     *
     * @test
     */
    public function it_should_job_instance_and_middlewares_attached_to_it()
    {
        $instance = new SaveRandomQuote($this->user, now());

        $this->assertInstanceOf(SaveRandomQuote::class, $instance);
        $this->assertIsArray($instance->middleware());
        $this->assertInstanceOf(RateLimited::class, $instance->middleware()[0]);
    }

    /**
     * Making sure the that the rate limit
     * is really limiting to one execution per day
     *
     * @test
     */
    public function it_should_verify_rate_limit()
    {
        Event::fake();

        Http::fakeSequence('https://api.quotable.io/random')
            ->push(['content' => 'An unexamined life is not worth living.'])
            ->push(['content' => 'Order your soul. Reduce your wants.']);

        $this->callJobToHitRateLimit();
        $this->callJobToTestIfRateLimitHasBeenReached();
        $this->callJobToTestIfRateLimitHasBeenExpired();
    }

    protected function callJobToHitRateLimit()
    {
        SaveRandomQuote::dispatch($this->user, Carbon::parse('2022-07-11'));

        $this->artisan('queue:work', ['--once' => true]);

        Event::assertDispatched(JobProcessed::class, function (JobProcessed $event) {
            return $event->job->isDeleted() && !$event->job->isReleased();
        });

        $this->assertDatabaseHas('daily_logs', [
            'user_id' => $this->user->id,
            'log'     => 'An unexamined life is not worth living.',
        ]);

        $this->assertDatabaseCount('daily_logs', 1);
    }

    /**
     * We travel five minutes in time and check if
     * the rate limit is ready to block new jobs from
     * the same user
     */
    protected function callJobToTestIfRateLimitHasBeenReached(): void
    {
        $this->travel(5)->minutes();

        SaveRandomQuote::dispatch($this->user, Carbon::parse('2022-07-11'));

        $this->artisan('queue:work', ['--once' => true]);

        $this->assertDatabaseMissing('daily_logs', [
            'user_id'    => $this->user->id,
            'created_at' => now(),
        ]);

        $this->assertDatabaseCount('daily_logs', 1);

        Event::assertDispatched(JobProcessed::class, function (JobProcessed $event) {
            return $event->job->isDeleted() && !$event->job->isReleased();
        });
    }

    /**
     * We should travel in time (one day + one minute)
     * in order to check if the job will be executed properly
     * after limit has been expired
     */
    protected function callJobToTestIfRateLimitHasBeenExpired()
    {
        $this->travel((60 * 60 * 24) + 1)->minutes();

        SaveRandomQuote::dispatch($this->user, Carbon::parse('2022-07-12'));

        $this->artisan('queue:work', ['--once' => true]);

        Event::assertDispatched(JobProcessed::class, function (JobProcessed $event) {
            return $event->job->isDeleted() && !$event->job->isReleased();
        });

        $this->assertDatabaseHas('daily_logs', [
            'user_id' => $this->user->id,
            'log'     => 'Order your soul. Reduce your wants.',
        ]);

        $this->assertDatabaseCount('daily_logs', 2);
    }
}
