<?php



namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();
        
        // Filter tasks based on the filter parameter
        if ($request->has('filter')) {
            if ($request->filter === 'active') {
                $query->where('is_completed', false);
            } elseif ($request->filter === 'completed') {
                $query->where('is_completed', true);
            }
        }
        
        $tasks = $query->latest()->get();
        $completedCount = Task::where('is_completed', true)->count();
        
        return view('tasks.index', compact('tasks', 'completedCount'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        
        Task::create([
            'title' => $request->title,
            'is_completed' => false,
        ]);
        
        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }
    
    public function update(Request $request, Task $task)
    {
        $task->update([
            'is_completed' => $request->has('is_completed'),
        ]);
        
        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }
    
    public function destroy(Task $task)
    {
        $task->delete();
        
        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
    
    // New method to toggle task completion status with a button
    public function toggle(Task $task)
    {
        $task->update([
            'is_completed' => !$task->is_completed,
        ]);
        
        return redirect()->route('tasks.index')
            ->with('success', 'Task status updated successfully.');
    }
    
    // New method to clear all completed tasks
    public function clearCompleted()
    {
        Task::where('is_completed', true)->delete();
        
        return redirect()->route('tasks.index')
            ->with('success', 'All completed tasks have been cleared.');
    }
}

