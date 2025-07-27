<?php

namespace App\Console\Commands;

use App\Models\Newsletters;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendScheduledNewsletters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-scheduled-newsletters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(\App\Services\NewsletterService::class)->processAll();
    }

}
