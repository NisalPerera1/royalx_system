<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }


    public function chat_index()
    {
        return view('chat-bot-support.index');
    }


    public function getResponse(Request $request)
    {
        $query = $request->input('query');
        $apiKey = env('OPENAI_API_KEY');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant for students.'],
                ['role' => 'user', 'content' => $query],
            ],
            'max_tokens' => 150,
            'temperature' => 0.7,
        ]);

        // Log the response for debugging
        \Log::info($response->json());

        // Check for errors in the response and handle accordingly
        $gptResponse = $response->json();

        if (!isset($gptResponse['choices']) || empty($gptResponse['choices'])) {
            return response()->json(['response' => 'Sorry, I could not process your request.']);
        }

        $botResponse = $gptResponse['choices'][0]['message']['content'] ?? 'I am unable to answer your question at this time.';

        return response()->json(['response' => $botResponse]);
    }


}
