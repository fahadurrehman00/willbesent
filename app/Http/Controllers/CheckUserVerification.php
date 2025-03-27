<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\AdminNotification;
use Carbon\Carbon;

class CheckUserVerification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $messageSentAt;

    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->messageSentAt = Carbon::now();
    }

    public function handle()
    {
        Log::info("CheckUserVerification Job started for user ID: {$this->userId}");

        $user = User::find($this->userId);

        if (!$user) {
            Log::warning("User not found for ID: {$this->userId}");
            return;
        }

        Log::info("User found: {$user->id}, Status: {$user->user_status}");

        // Check if the message was sent within the last 2 minutes
        $timeSinceMessageSent = Carbon::now()->diffInMinutes($this->messageSentAt);
        Log::info("Time since message sent: {$timeSinceMessageSent} minutes");

        if ($timeSinceMessageSent <= 2 && $user->user_status === false) {
            Log::info("User verification is still false, sending email to admin.");
            
            // Send an email to the admin
            Mail::to('fahadurrehman001@gmail.com')->send(new AdminNotification($user));

            Log::info("Email sent to admin for user ID: {$user->id}");
        } else {
            Log::info("Conditions not met, email not sent.");
        }
    }
}
