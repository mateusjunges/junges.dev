<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class TestMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function build(): Mailable
    {
        return $this->markdown('mails.test');
    }
}
