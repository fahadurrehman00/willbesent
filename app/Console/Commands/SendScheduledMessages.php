<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Twilio\Rest\Client;
use Carbon\Carbon;

class SendScheduledMessages extends Command
{
    protected $signature = 'send:scheduled-messages';
    protected $description = 'Send messages based on user frequency settings';

    public function handle()
    {
        $twilioSid = env('TWILIO_SID');
        $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');
        $now = Carbon::now();

        $client = new Client($twilioSid, $twilioAuthToken);


        // Fetch users who have a scheduled time
        $users = User::whereNotNull('message_time')->get();


        foreach ($users as $user) {
            $frequency = strtolower($user->frequency);
            $messageTime = Carbon::parse($user->message_time);
            $lastMessageSentAt = $user->last_message_sent_at ? Carbon::parse($user->last_message_sent_at) : null;

            if ($now->format('H:i') !== $messageTime->format('H:i')) {
                $shouldSendMessage = false;

                switch ($frequency) {
                    case 'daily':
                        $shouldSendMessage = true;
                        break;

                    case 'weekly':
                        if ($now->dayOfWeek === $messageTime->dayOfWeek) {
                            $shouldSendMessage = true;
                        }
                        break;

                    case 'monthly':
                        if ($now->day === $messageTime->day) {
                            $shouldSendMessage = true;
                        }
                        break;
                }

                // Ensure message wasn't already sent today
                if ($shouldSendMessage && (!$lastMessageSentAt || !$lastMessageSentAt->isToday())) {
                    try {
                        $client->messages->create(
                            "+18153416531",
                            // $user->phone_number,
                            [
                                'from' => $twilioPhoneNumber,
                                'body' => "Hello {$user->name}, please verify your account to continue using our services. Click the link below to verify your account: https://willbesent.com/user/verification"
                                    ]
                        );                        

                        // $this->info("Message sent to {$user->phone_number}");
                        $this->info("Message sent to +18153416531");

                        $user->update(['last_message_sent_at' => $now]);
                    } catch (\Exception $e) {
                        $this->error("Failed to send message to {$user->phone_number}: " . $e->getMessage());
                    }
                }
            }


        }

        $this->info('Scheduled messages processed successfully!');
    }
}
