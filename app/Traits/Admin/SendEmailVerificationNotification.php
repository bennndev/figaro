<?php

namespace App\Traits\Admin;

use App\Notifications\Admin\Auth\VerifyEmail; 

trait SendEmailVerificationNotification
{
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }
}
