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
            
            $validated = $request->validate([
                'nbfc_id' => 'required|string',
                'student_id' => 'required|string',
                'sender_id' => 'required|string',
                'receiver_id' => 'required|string',
                'message' => 'required|string',
                'is_read' => 'boolean'
            ]);

             $conversation = Conversation::firstOrCreate([
                'nbfc_id' => $validated['nbfc_id'],
                'student_id' => $validated['student_id'],
            ]);

             Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $validated['sender_id'],
                'receiver_id' => $validated['receiver_id'],
                'message' => $validated['message'],
                'is_read' => $validated['is_read']
            ]);

            return response()->json(['message' => 'Message sent successfully'], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            
            return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);

        } catch (\Exception $e) {
            
            return response()->json(['error' => 'Something went wrong', 'details' => $e->getMessage()], 500);
        }
    }

    public function getMessages($nbfc_id, $student_id)
    {

        $conversation = Conversation::with('messages')
            ->where('nbfc_id', $nbfc_id)
            ->where('student_id', $student_id)
            ->first();

        
        if (!$conversation) {
            return response()->json(['error' => 'No conversation found'], 404);
        }

        if ($conversation->messages->isEmpty()) {
            return response()->json(['message' => 'No messages found in the conversation'], 200);
        }

        return response()->json([
            'messages' => $conversation->messages,
            'conversation_id' => $conversation->id
        ], 200);
    }

    public function groupCountingChats($nbfc_id, $student_id)
    {
        try {
            $conversationsCount = Message::where('sender_id', $nbfc_id)
                ->where('receiver_id', $student_id)
                ->count();

            return response()->json([
                'success' => true,
                'message' => "Each Message Count Retrieved",
                'counts' => $conversationsCount
            ], 200);
            

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }


}
