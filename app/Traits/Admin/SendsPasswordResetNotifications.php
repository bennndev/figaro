<?php

namespace App\Traits\Admin;

use App\Notifications\Admin\Auth\ResetPasswordNotification;

trait SendsPasswordResetNotifications
{
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
