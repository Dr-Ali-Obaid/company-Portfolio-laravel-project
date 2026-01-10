<?php

namespace App\Console\Commands;

use App\Models\Subscriber;
use Illuminate\Console\Command;

class CleanUnverifiedSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribers:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete subscribers who have not verified their email within 30 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $deletedCount = Subscriber::whereNull('verified_at')->where('created_at', '<', now()->subMinutes(1))->delete();

       if($deletedCount > 0) {
           $this->info("success: {$deletedCount} unverified subscribers deleted.");
       }else{
           $this->comment("No unverified subscribers found.");
       }
    }
}
