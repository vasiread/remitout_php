<?php

namespace App\Http\Controllers;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        try {
            // Validate incoming request
            $validated = $request->validate([
                'nbfc_id' => 'required|string',
                'student_id' => 'required|string',
                'sender_id' => 'required|string',
                'receiver_id' => 'required|string',
                'message' => 'required|string',
            ]);

            // Create or find the conversation
            $conversation = Conversation::firstOrCreate([
                'nbfc_id' => $validated['nbfc_id'],
                'student_id' => $validated['student_id'],
            ]);

            // Save the message
            Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $validated['sender_id'],
                'receiver_id' => $validated['receiver_id'],
                'message' => $validated['message'],
            ]);

            return response()->json(['message' => 'Message sent successfully'], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);

        } catch (\Exception $e) {
            // Handle general errors
            return response()->json(['error' => 'Something went wrong', 'details' => $e->getMessage()], 500);
        }
    }

    public function getMessages($nbfc_id, $student_id)
    {
      

        // Find the conversation and eager-load the messages
        $conversation = Conversation::with('messages')
            ->where('nbfc_id', $nbfc_id)
            ->where('student_id', $student_id)
            ->first();

        // If no conversation is found, return an error message
        if (!$conversation) {
            return response()->json(['error' => 'No conversation found'], 404);
        }

        // Check if there are no messages in the conversation
        if ($conversation->messages->isEmpty()) {
            return response()->json(['message' => 'No messages found in the conversation'], 200);
        }

        // Return all messages from the conversation
        return response()->json([
            'messages' => $conversation->messages,
            'conversation_id' => $conversation->id
        ], 200);
    }

}
