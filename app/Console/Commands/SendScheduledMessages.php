<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Twilio\Rest\Client;
use Carbon\Carbon;

class SendScheduledMessages extends Command
{
    protected $signature = 'send:scheduled-messages';
    protected $description = 'Send messages based on frequency';

    public function handle()
    {
        $twilioSid = env('TWILIO_SID');
        $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');
        $now = Carbon::now();

        // Fetch users who are eligible to receive messages
        $users = User::all();

        foreach ($users as $user) {
            $frequency = strtolower($user->frequency);
            $messageTime = Carbon::parse($user->message_time); // User's preferred message time
            $lastMessageSentAt = $user->last_message_sent_at ? Carbon::parse($user->last_message_sent_at) : null;

            // Check if the current time matches the user's preferred time and frequency
            $shouldSendMessage = false;

            switch ($frequency) {
                case 'daily':
                    // Check if the current time matches the user's preferred time
                    if ($now->format('H:i') === $messageTime->format('H:i')) {
                        $shouldSendMessage = true;
                    }
                    break;

                case 'weekly':
                    // Check if today is the same day of the week and the time matches
                    if ($now->isSameDay($messageTime) && $now->format('H:i') === $messageTime->format('H:i')) {
                        $shouldSendMessage = true;
                    }
                    break;

                case 'monthly':
                    // Check if today is the same day of the month and the time matches
                    if ($now->day === $messageTime->day && $now->format('H:i') === $messageTime->format('H:i')) {
                        $shouldSendMessage = true;
                    }
                    break;
            }

            // Ensure the message wasn't already sent today
            if ($shouldSendMessage && (!$lastMessageSentAt || !$lastMessageSentAt->isToday())) {
                // Prepare curl request
                $toPhoneNumber = $user->phone_number; // Fetch phone number from user record
                $messageBody = "Your scheduled message content here.";

                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://api.twilio.com/2010-04-01/Accounts/{$twilioSid}/Messages.json",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => http_build_query([
                        'To' => $toPhoneNumber,
                        'From' => $twilioPhoneNumber,
                        'Body' => $messageBody,
                    ]),
                    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                    CURLOPT_USERPWD => "{$twilioSid}:{$twilioAuthToken}",
                ]);

                $response = curl_exec($curl);
                $error = curl_error($curl);
                curl_close($curl);

                if ($error) {
                    $this->error("Curl Error: {$error}");
                } else {
                    $this->info("Message sent successfully: {$response}");

                    // Update last_message_sent_at to prevent duplicate messages
                    $user->update(['last_message_sent_at' => $now]);
                }
            }
        }

        $this->info('Scheduled messages processed successfully!');
    }

}

