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
    use Queueable, SerializesModels, InteractsWithQueue,Dispatchable;

    /**
     * Create a new job instance.
     */
    public $newsletter;
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
                Mail::to($subscriber->email)->send(new Newsletter($this->newsletter ));
                usleep(100000);
            }
            sleep(1);
        });
        NewsletterModel::where('id', $this->newsletter->id)->update(['sent_at' => now()]);
        event(new NewsletterStatusUpdated($this->newsletter));
    }
}
