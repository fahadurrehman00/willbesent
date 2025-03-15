<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'document' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $user = Auth::user();

        if ($user->documents()->where('documnet_type', $request->document_type)->count() >= 1) {
            return response()->json([
                'error' => true,
                'message' => "You can only upload one {$request->document_type} document.",
            ], 400);
        }

        if ($request->file('document')) {
            $file = $request->file('document');
            $path = $file->store('documents', 'public');
            $document = Document::create([
                'user_id' => Auth::id(),
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'type' => $file->getClientMimeType(),
                'documnet_type' => $request->document_type,
            ]);
            return response()->json(['success' => true,'document' => $document, 'message' => 'Document uploaded successfully!']);
        }

        return response()->json(['message' => 'Upload failed'], 400);
    }

    public function index()
    {
        $user = auth()->user();
        $documents = Document::where('user_id', $user->id)
            ->where('documnet_type', 'will')
            ->get();
        return response()->json($documents);
    }
    public function attornyDocuments()
    {
        $user = auth()->user();
        $documents = Document::where('user_id', $user->id)
            ->where('documnet_type', 'attorny')
            ->get();
        return response()->json($documents);
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        Storage::disk('public')->delete($document->path);
        $document->delete();
        return response()->json(['message' => 'Document deleted successfully']);
    }
}

