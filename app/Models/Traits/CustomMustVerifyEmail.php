<?php
namespace App\Models\Traits;

use App\Constant\PrimaryKeyConstant;
use App\Constant\TableNameConstant;
use App\Notifications\CustomEmailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Log;

Trait CustomMustVerifyEmail{
    //*Determine Has Verified Email
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    //* Mark Email As Verified
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    //* Send Email Notification
    public function sendEmailVerificationNotification()
    {
        //* try  - catch here? //* Jika 
        try {
            $this->notify(new CustomEmailVerifyNotification());
        } catch (\Throwable $e) {
            Log::info($e);
            // Handle the exception
        }
    }

    //* Email For Verification
    public function getEmailForVerification()
    {
        return $this->email;
    }
}
