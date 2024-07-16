<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyEntry;

class DayController extends Controller
{
    public function storeOrUpdate(Request $request, $day_id)
    {
        $validatedData = $request->validate([
            'updated_entry' => 'required|string|max:500',
        ]);
        
        try {
            
            DailyEntry::create([
                'day_id' => $day_id,
                'content' => $validatedData['updated_entry'],
            ]);
            return redirect()->back()->with('success', 'Entry saved successfully.');
        } catch 
        (\Exception $e) {
            // Update logic
            $day = DailyEntry::findOrFail($day_id);
            $day->update(['content' => $validatedData['updated_entry']]);
            return redirect()->back()->with('success', 'Entry updated successfully.');
        }
    }

    
    public function showDay(int $id)
    {
        // Fetch the most recent entry for the selected day, if any
        $latestEntry = DailyEntry::where('day_id', $id)->latest()->first();

        // Pass the latest entry to the view
        return view('day_view', [
            'day_id' => $id,
            'entries' => $entries = DailyEntry::whereDate('created_at', $id)->get(),
            'latestEntry' => $latestEntry // Pass the latest entry to the view
        ]);
    }

}
