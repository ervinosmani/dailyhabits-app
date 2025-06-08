<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\HabitCompletion;
use Illuminate\Http\Request;

class HabitCompletionController extends Controller
{
    public function index(Request $request, $habitId)
    {
        $habit = Habit::findOrFail($habitId);

        if ($habit->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $completions = $habit->completions()->orderBy('date', 'asc')->get(['date']);

        return response()->json([
            'data' => $completions
        ]);
    }

    public function store(Request $request, $habitId)
    {
        $habit = Habit::findOrFail($habitId);

        if ($habit->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'date' => 'required|date',
        ]);

        $completion = HabitCompletion::firstOrCreate([
            'habit_id' => $habit->id,
            'date' => $validated['date'],
        ]);

        return response()->json([
            'message' => 'Habit marked as completed',
            'data' => $completion
        ]);
    }

    public function destroy(Request $request, $habitId)
    {
        $habit = Habit::findOrFail($habitId);

        if ($habit->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'date' => 'required|date',
        ]);

        $deleted = HabitCompletion::where('habit_id', $habit->id)
            ->where('date', $request->date)
            ->delete();

        return response()->json([
            'message' => $deleted ? 'Completion removed' : 'Completion not found'
        ]);
    }
}
