<?php

namespace App\Http\Controllers;

use App\Mail\AdminRecipentMail;
use App\Mail\RecipentMail;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RecipientController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $type = $request->input('poa-recipient') ?? 'will'; // Default to 'will' if null

        // Check recipient limits
        $willCount = $user->recipients()->where('type', 'will')->count();
        $attorneyCount = $user->recipients()->where('type', 'attorny')->count();

        if ($type == 'will' && $willCount >= 2) {
            return response()->json([
                'error' => true,
                'message' => 'You cannot upload more than two "will" recipients',
            ], 400);
        }

        if ($type == 'attorny' && $attorneyCount >= 2) {
            return response()->json([
                'error' => true,
                'message' => 'You cannot upload more than two "attorney" recipients',
            ], 400);
        }

        // If updating existing recipient, keep the previous type
        if ($request->id !== null) {
            $existingRecipient = Recipient::find($request->id);
            $type = $existingRecipient ? $existingRecipient->type : $type;
        }

        // Create or update recipient
        $recipient = Recipient::updateOrCreate(
            ['id' => $request->id],
            [
                'user_id' => Auth::id(),
                'name' => $request->firstname . ' ' . $request->lastname,
                'mobile' => $request->phone,
                'email' => $request->email,
                'type' => $type,
                'state' => $request->state,
                'zip' => $request->zip,
                'city' => $request->city,
                'street' => $request->street,
            ]
        );

        // Send email to recipient and admin
        Mail::to($recipient->email)->send(new RecipentMail($recipient, $user));
        Mail::to("willbesent@arvoequities.com")->send(new AdminRecipentMail($recipient, $user));

        return response()->json(['success' => true, 'recipient' => $recipient]);
    }

    public function show(Request $request)
    {
        $recipient = Recipient::find($request->id);
        if (!$recipient) {
            return response()->json(['error' => true, 'message' => 'Recipient not found'], 404);
        }
        return response()->json(['success' => true, 'recipient' => $recipient]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
        ]);

        $recipient = Recipient::findOrFail($id);

        $recipient->update([
            'user_id' => Auth::id(),
            'name' => $request->firstname . ' ' . $request->lastname,
            'mobile' => $request->phone,
            'email' => $request->email,
            'state' => $request->state,
            'zip' => $request->zip,
            'city' => $request->city,
            'street' => $request->street,
        ]);

        return response()->json(['success' => true, 'recipient' => $recipient]);
    }

    public function delete($id)
    {
        $recipient = Recipient::findOrFail($id);
        $recipient->delete();

        return response()->json(['success' => true, 'message' => 'Recipient deleted successfully.']);
    }

    public function willlist()
    {
        $user = auth()->user();
        $recipients = Recipient::where('user_id', $user->id)
            ->where('type', 'will')
            ->get();
        return response()->json(['success' => true, 'recipients' => $recipients]);
    }

    public function list()
    {
        $user = Auth::user();
        $recipients = Recipient::where('user_id', $user->id)
            ->where('type', 'attorny')
            ->get();
        return response()->json(['success' => true, 'recipients' => $recipients]);
    }
}
