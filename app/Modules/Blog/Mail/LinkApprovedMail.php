<?php

namespace App\Modules\Blog\Mail;

use App\Modules\Blog\Models\Link;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LinkApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Link $link
    ) {
    }

    public function build(): Mailable
    {
        return $this->markdown('mails.links.approved');
    }
}
