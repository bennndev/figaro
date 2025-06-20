<?php

namespace App\Traits\Barber;

use App\Notifications\Barber\Auth\VerifyEmail; 

trait SendEmailVerificationNotification
{
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }
}
