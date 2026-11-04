<?php

namespace App\Jobs;

use App\Events\NewsletterStatusUpdated;
use App\Mail\Newsletter;
use App\Models\Newsletter as NewsletterModel;
use App\Models\Subscriber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewsletterJob implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue, Dispatchable;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 300;

    /**
     * The newsletter model instance.
     *
     * @var \App\Models\Newsletter
     */
    public $newsletter;

    /**
     * Create a new job instance.
     */
    public function __construct(NewsletterModel $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Subscriber::chunk(25, function ($subscribers) {
            foreach ($subscribers as $subscriber) {
                $this->newsletter->token = $subscriber->token;
                Mail::to($subscriber->email)->send(new Newsletter($this->newsletter));
                usleep(100000);
            }
            sleep(1);
        });

        // Update the sent timestamp directly on the loaded model instance
        $this->newsletter->update(['sent_at' => now()]);

        // Broadcast the real-time status update event
        event(new NewsletterStatusUpdated($this->newsletter));
    }
}
