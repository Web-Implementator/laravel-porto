<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Mails;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

abstract class MailAbstract extends Mailable
{
    use SerializesModels;
}
