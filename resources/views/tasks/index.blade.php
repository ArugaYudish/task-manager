@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Task Manager</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add Task</a>

    <p>Total Tasks: {{ $tasks->count() }}</p>

    <h3>Overdue Tasks</h3>
    <ul>
        @foreach ($overdueTasks as $task)
            <li>{{ $task->title }} ({{ $task->created_at->format('Y-m-d') }})</li>
        @endforeach
    </ul>

    <h3>Task Statuses</h3>
    <ul>
        @foreach ($taskStatuses as $status => $count)
            <li>{{ $status }}: {{ $count }}</li>
        @endforeach
    </ul>



    {{-- Penggunaan If Then Else --}}
    @if ($tasks->isEmpty())
        <p class="text-center">{{ $message }}</p>
    @else
        <div class="list-group">
            {{-- Pengunaan Looping For --}}
            @foreach ($tasks as $task)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">{{ $task->title }}</h5>
                        <p class="mb-1">{{ $task->description }}</p>
                        <small class="text-muted">Status: {{ $task->status }}</small>
                    </div>
                    {{-- <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="ml-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form> --}}
                </div>
            @endforeach

        </div>
    @endif
@endsection
