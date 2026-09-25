@extends('layouts.app')

@section('title', 'Add Task')

@section('content')

    <div class="card" style="max-width:560px;">
        <h2 style="margin-top:0;">Add New Task</h2>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <label for="task_name">Task Name</label>
            <input type="text" id="task_name" name="task_name" value="{{ old('task_name') }}" placeholder="e.g. Finish Laravel project">
            @error('task_name') <div class="error-text">{{ $message }}</div> @enderror

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Optional details...">{{ old('description') }}</textarea>
            @error('description') <div class="error-text">{{ $message }}</div> @enderror

            <label for="due_date">Due Date</label>
            <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}">
            @error('due_date') <div class="error-text">{{ $message }}</div> @enderror

            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
            @error('status') <div class="error-text">{{ $message }}</div> @enderror

            <div class="form-actions">
                <button type="submit" class="btn-primary" style="border:none;cursor:pointer;">Save Task</button>
                <a href="{{ route('tasks.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

@endsection