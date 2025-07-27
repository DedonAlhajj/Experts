<?php

namespace App\Mail;

use App\Models\Newsletters;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use SerializesModels;

    public function __construct(public Newsletters $newsletter)
    {
    }

    public function build(): self
    {
        $bgUrl = $this->newsletter->hasMedia('newsletters')
            ? $this->newsletter->getFirstMediaUrl('newsletters')
            : asset('images/default.jpg');

        return $this->subject($this->newsletter->title)
            ->view('emails.newsletter')
            ->with([
                'newsletter' => $this->newsletter,
                'bgUrl' => $bgUrl
            ]);
    }
}

