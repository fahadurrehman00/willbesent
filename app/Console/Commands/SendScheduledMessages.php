<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Twilio\Rest\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendScheduledMessages extends Command
{
    protected $signature = 'send:scheduled-messages';
    protected $description = 'Send messages based on user frequency settings';

    public function handle()
    {
        Log::info("Scheduled message command started at " . Carbon::now());

        $twilioSid = env('TWILIO_SID');
        $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_phone');
        $now = Carbon::now();

        $client = new Client($twilioSid, $twilioAuthToken);

        // Fetch users who have a scheduled message time
        $users = User::whereNotNull('message_time')->get();
        Log::info("Total users found: " . $users->count());

        foreach ($users as $user) {
            $messageTime = Carbon::parse($user->message_time);
            $lastMessageSentAt = $user->last_message_sent_at ? Carbon::parse($user->last_message_sent_at) : null;

            Log::info("Checking user: {$user->name}, Phone: {$user->phone}, Scheduled Time: {$messageTime->format('H:i')}, Frequency: {$user->frequency}");

            // Check if the current time matches the scheduled time
            if ($now->format('H:i') === $messageTime->format('H:i')) {
                $shouldSendMessage = false;

                switch (strtolower($user->frequency)) {
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
                            $user->phone,
                            [
                                'from' => $twilioPhoneNumber,
                                'body' => "Hello {$user->name}, please verify your account to continue using our services. Click the link below to verify your account: https://willbesent.com/user/verification"
                            ]
                        );

                        Log::info("Message sent successfully to {$user->phone}");
                        $this->info("Message sent to {$user->phone}");

                        // Update last_message_sent_at to prevent duplicate messages
                        $user->update(['last_message_sent_at' => $now]);
                    } catch (\Exception $e) {
                        Log::error("Failed to send message to {$user->phone}: " . $e->getMessage());
                        $this->error("Failed to send message to {$user->phone}: " . $e->getMessage());
                    }
                } else {
                    Log::info("Skipping message for {$user->phone}, already sent today or conditions not met.");
                }
            } else {
                Log::info("Current time ({$now->format('H:i')}) does not match scheduled time ({$messageTime->format('H:i')}) for {$user->phone}");
            }
        }

        Log::info('Scheduled messages processed successfully!');
        $this->info('Scheduled messages processed successfully!');
    }
}
