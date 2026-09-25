@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')

    <div class="stats">
        <div class="stat">
            <div class="num">{{ $counts['total'] }}</div>
            <div class="label">Total Tasks</div>
        </div>
        <div class="stat">
            <div class="num" style="color:#F59E0B">{{ $counts['pending'] }}</div>
            <div class="label">Pending</div>
        </div>
        <div class="stat">
            <div class="num" style="color:#22C55E">{{ $counts['completed'] }}</div>
            <div class="label">Completed</div>
        </div>
    </div>

    <div class="filters">
        <a href="{{ route('tasks.index') }}" class="{{ request('status') ? '' : 'active' }}">All</a>
        <a href="{{ route('tasks.index', ['status' => 'Pending']) }}" class="{{ request('status') == 'Pending' ? 'active' : '' }}">Pending</a>
        <a href="{{ route('tasks.index', ['status' => 'Completed']) }}" class="{{ request('status') == 'Completed' ? 'active' : '' }}">Completed</a>
    </div>

    <div class="card">
        @if ($tasks->isEmpty())
            <div class="empty">No tasks yet. Click <strong>+ New Task</strong> to add one.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td><strong>{{ $task->task_name }}</strong></td>
                            <td>{{ Str::limit($task->description, 40) ?: '—' }}</td>
                            <td class="{{ $task->isOverdue() ? 'overdue' : '' }}">
                                {{ $task->due_date ? $task->due_date->format('M d, Y') : '—' }}
                                @if ($task->isOverdue()) (overdue) @endif
                            </td>
                            <td>
                                <span class="badge {{ $task->status == 'Completed' ? 'badge-completed' : 'badge-pending' }}">
                                    {{ $task->status }}
                                </span>
                            </td>
                            <td class="actions">
                                <form action="{{ route('tasks.updateStatus', $task) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="{{ $task->status == 'Completed' ? 'Pending' : 'Completed' }}">
                                    <button type="submit" class="btn btn-toggle">
                                        Mark {{ $task->status == 'Completed' ? 'Pending' : 'Done' }}
                                    </button>
                                </form>

                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-edit">Edit</a>

                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                      onsubmit="return confirm('Delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection