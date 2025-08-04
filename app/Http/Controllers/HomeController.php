<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\Loan;
use App\Models\Client;





class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
public function index()
{
    $today = Carbon::today();
    $startOfWeek = Carbon::now()->startOfWeek();
    $startOfMonth = Carbon::now()->startOfMonth();
    $startOfYear = Carbon::now()->startOfYear();

    $dailyLoanAmount = Loan::whereDate('created_at', $today)->sum('loan_amount');
    $dailyLoanCount = Loan::whereDate('created_at', $today)->count();

    $weeklyLoanAmount = Loan::whereBetween('created_at', [$startOfWeek, now()])->sum('loan_amount');
    $weeklyLoanCount = Loan::whereBetween('created_at', [$startOfWeek, now()])->count();

    $monthlyLoanAmount = Loan::whereBetween('created_at', [$startOfMonth, now()])->sum('loan_amount');
    $monthlyLoanCount = Loan::whereBetween('created_at', [$startOfMonth, now()])->count();

    $yearlyLoanAmount = Loan::whereYear('created_at', now()->year)->sum('loan_amount');
    $yearlyLoanCount = Loan::whereYear('created_at', now()->year)->count();

    $loanChartData = Loan::selectRaw('DATE(created_at) as date, SUM(loan_amount) as total')
        ->where('created_at', '>=', now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date')
        ->pluck('total', 'date');

    $totalLoanCount = Loan::count();

    $statusBreakdown = Loan::selectRaw('status, COUNT(*) as count')
        ->groupBy('status')
        ->pluck('count', 'status');

    $recentLoans = Loan::with('client')->latest()->take(5)->get();

    $recentLoans->transform(function ($loan) {
        $status = ucfirst($loan->status);

        $badgeClass = match($loan->status) {
            'completed' => 'bg-success',
            'defaulted' => 'bg-danger',
            'active' => 'bg-warning text-dark',
            default => 'bg-secondary',
        };

        $loan->status_badge = '<span class="badge ' . $badgeClass . '">' . $status . '</span>';
        return $loan;
    });

    return view('home', compact(
        'dailyLoanAmount', 'dailyLoanCount',
        'weeklyLoanAmount', 'weeklyLoanCount',
        'monthlyLoanAmount', 'monthlyLoanCount',
        'yearlyLoanAmount', 'yearlyLoanCount',
        'loanChartData', 'totalLoanCount',
        'recentLoans', 'statusBreakdown'
    ));
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
