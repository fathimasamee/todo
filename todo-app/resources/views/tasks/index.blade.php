<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .completed-task {
            text-decoration: line-through;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4">To-Do List</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="card mb-4">
            <div class="card-header">Add New Task</div>
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                               placeholder="Enter a new task" required>
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </form>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>My Tasks</span>
                <div class="btn-group">
                    <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-secondary {{ request()->get('filter') ? '' : 'active' }}">All</a>
                    <a href="{{ route('tasks.index', ['filter' => 'active']) }}" class="btn btn-sm btn-outline-secondary {{ request()->get('filter') == 'active' ? 'active' : '' }}">Active</a>
                    <a href="{{ route('tasks.index', ['filter' => 'completed']) }}" class="btn btn-sm btn-outline-secondary {{ request()->get('filter') == 'completed' ? 'active' : '' }}">Completed</a>
                </div>
            </div>
            <div class="card-body">
                @if($tasks->count() > 0)
                    <ul class="list-group">
                        @foreach($tasks as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-check">
                                            <input type="checkbox" name="is_completed" class="form-check-input task-checkbox" 
                                                   onChange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}>
                                            <label class="form-check-label {{ $task->is_completed ? 'completed-task' : '' }}">
                                                {{ $task->title }}
                                            </label>
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-info me-1">
                                            {{ $task->is_completed ? 'Mark as Active' : 'Mark as Completed' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    
                    <div class="mt-3 d-flex justify-content-between">
                        <span>{{ $tasks->count() }} tasks</span>
                        @if($completedCount > 0)
                            <form action="{{ route('tasks.clear-completed') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Clear Completed</button>
                            </form>
                        @endif
                    </div>
                @else
                    <p class="text-center">No tasks yet. Add a task to get started!</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>