<?php
namespace App\Http\Controllers;

use App\Models\FocusSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FocusSessionController extends Controller
{
    public function start(Request $request)
    {
        $request->validate([
            'duration_minutes' => 'required|integer|min:1',
        ]);

        $session = FocusSession::create([
            'user_id' => Auth::id(),
            'duration_minutes' => $request->duration_minutes,
            'status' => 'ongoing',
        ]);

        return response()->json(['message' => 'Sesi fokus dimulai', 'session' => $session]);
    }

    public function stop(Request $request)
    {
        $session = FocusSession::where('user_id', Auth::id())
            ->where('status', 'ongoing')
            ->latest()
            ->first();

        if ($session) {
            $session->update(['status' => 'completed']);
            return response()->json(['message' => 'Sesi fokus dihentikan']);
        }

        return response()->json(['message' => 'Tidak ada sesi yang sedang berjalan'], 404);
    }
}
