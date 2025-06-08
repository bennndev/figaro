<?php

namespace App\Traits\Barber;

use App\Notifications\Barber\Auth\ResetPasswordNotification;

trait SendsPasswordResetNotifications
{
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
