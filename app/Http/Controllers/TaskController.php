<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        foreach ($tasks as $task) {
            if ($task->deadline) {
                $task->deadline = Carbon::parse($task->deadline);
            }
        }
        
        return view('tasks.index', compact('tasks'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   // app/Http/Controllers/TaskController.php

   public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date_format:Y-m-d\TH:i',
        ]);

        $task = new Task;
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->deadline = Carbon::parse($validatedData['deadline']); // Convert to Carbon instance
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        $task->update($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    //
    public function toggleCompletion(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->is_completed = $request->input('is_completed');
        $task->save();

        return response()->json(['success' => true]);
    }

    public function showScreenshot(Request $request)
    {
        $title = $request->query('title');
        $screenshotUrl = $request->query('screenshot');

        // Render the page with the screenshot and title
        return view('blog', ['title' => $title, 'screenshotUrl' => $screenshotUrl]);
    }
    

    
   
  

}
