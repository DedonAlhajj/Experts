<?php

namespace App\Jobs;

use App\Mail\NewsletterMail;
use App\Models\Newsletters;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewsletterToSubscriberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public function __construct(public string $email, public Newsletters $newsletter) {}

    public function handle(): void
    {
        Mail::to($this->email)->send(
            new NewsletterMail($this->newsletter)
        );
    }

}
