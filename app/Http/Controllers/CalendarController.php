<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar');
    }

    public function events(Request $request)
    {
        $query = Todo::where('user_id', Auth::id());

        if ($request->has('date')) {
            $query->whereDate('deadline', $request->date);
        }

        $todos = $query->get();

        return response()->json($todos->map(function ($todo) {
            return [
                'title' => $todo->name,
                'description' => $todo->description,
                'start' => $todo->deadline,
            ];
        }));
    }
}
