<?php

declare(strict_types=1);

namespace App\Ship\Parents\Mails;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

abstract class Mail extends Mailable
{
    use SerializesModels;
}
