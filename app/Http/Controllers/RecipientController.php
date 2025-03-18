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

        if($request->id == null){
            if ($request->input('poa-recipient') == null) {
                $type = 'will';
            } else {
                $type = $request->input('poa-recipient');
            }


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
        }

        $recipientData = [
            'user_id' => Auth::id(),
            'name' => $request->firstname . ' ' . $request->lastname,
            'mobile' => $request->phone,
            'email' => $request->email,
            'state' => $request->state,
            'zip' => $request->zip,
            'city' => $request->city,
        ];

        if ($request->id !== null) {
            $rec = Recipient::where('id', $request->id)->first();
            $type = $rec->type;
        }

        $recipient = Recipient::updateOrCreate(
            // Condition to check if the recipient exists
            ['id' => $request->id], // Check if the recipient ID exists in the request
            // Data to update or create
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
        Mail::to($request->email)->send(new RecipentMail($user));
        Mail::to("WBS@arvoequities.com")->send(new AdminRecipentMail($user));
        return response()->json(['success' => true, 'recipient' => $recipient]);
    }

    public function show(Request $request){
        $recipient = Recipient::find($request->id);
        return response()->json(['success' => true,'recipient' => $recipient]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email',
        ]);

        $recipient = Recipient::findOrFail($id);

        $recipient->update([
            'user_id' => Auth::id(),
            'name' => $request->firstname . ' ' . $request->lastname,
            'mobile' => $request->phone,
            'email' => $request->email,
            'type' => $type,
            'state' => $request->state,
            'zip' => $request->zip,
            'city' => $request->city,
            'street' => $request->street,
        ]);

        return response()->json(['success' => true, 'recipient' => $recipient]);
    }

    public function delete($id)
    {
        Recipient::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Recipient deleted successfully.');
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
