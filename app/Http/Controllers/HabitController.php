<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habit;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habits = Habit::all();

        return response()->json([
            'data' => $habits
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validimi i te dhenave te ardhura nga frontend
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'frequency' => 'required|in:daily,weekly,monthly',
            'start_date' => 'required|date',
        ]);

        // Ruajtja ne databaze(pa user_id per momentin)
        $habit = Habit::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'frequency' => $validated['frequency'],
            'start_date' => $validated['start_date'],
            'user_id' => $request->user()->id, // per testim tani(do zevendesojme me auth me vone)
        ]);

        // Kthimi i pergjigjes
        return response()->json([
            'message' => 'Habit created successfully',
            'data' => $habit
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $habit = Habit::find($id);

        if (!$habit) {
            return response()->json([
                'message' => 'Habit not found'
            ], 404);
        }

        return response()->json([
            'data' => $habit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $habit = Habit::find($id);

        if (!$habit) {
            return response()->json([
                'message' => 'Habit not found'
            ], 404);
        }

        // Validimi i inputit
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'frequency' => 'required|in:daily,weekly,monthly',
            'start_date' => 'required|date',
        ]);

        // Perditesimi ne databaze
        $habit->update($validated);

        // Kthimi i pergjigjes
        return response()->json([
            'message' => 'Habit updated successfully',
            'data' => $habit
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $habit = Habit::find($id);

        if (!$habit) {
            return response()->json([
                'message' => 'Habit not found'
            ], 404);
        }

        $habit->delete();

        return response()->json([
            'message' => 'Habit deleted successfully'
        ], 200);
    }
}
