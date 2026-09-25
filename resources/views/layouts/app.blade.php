<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Manager')</title>
   ```css
<style>

    :root {
        --bg: #09090F;
        --card: #11111B;
        --card-hover: #181827;

        --primary: #4F46E5;
        --primary-dark: #7C3AED;
        --accent: #06B6D4;

        --text: #F8FAFC;
        --muted: #94A3B8;
        --border: #27273A;

        --pending: #F59E0B;
        --completed: #22C55E;
        --danger: #EF4444;

        --shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        background:
            radial-gradient(
                circle at 10% 20%,
                rgba(79, 70, 229, 0.15),
                transparent 35%
            ),
            radial-gradient(
                circle at 90% 80%,
                rgba(124, 58, 237, 0.12),
                transparent 35%
            ),
            var(--bg);
        color: var(--text);
        min-height: 100vh;
    }

    /* Navigation */

    nav {
        background:
            linear-gradient(
                135deg,
                var(--primary),
                var(--primary-dark)
            );
        color: #fff;
        padding: 18px 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.25);
    }

    nav .brand {
        font-size: 1.25rem;
        font-weight: 700;
        letter-spacing: .3px;
    }

    nav a.btn-new {
        background: #fff;
        color: var(--primary-dark);
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: .9rem;
        transition: .2s ease;
    }

    nav a.btn-new:hover {
        background: #EDE9FE;
        transform: translateY(-1px);
    }

    /* Main Container */

    .container {
        max-width: 1000px;
        margin: 32px auto;
        padding: 0 20px;
    }

    /* Cards */

    .card {
        background: rgba(17, 17, 27, 0.92);
        border-radius: 14px;
        padding: 24px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        backdrop-filter: blur(10px);
    }

    /* Success Alert */

    .alert-success {
        background: rgba(34, 197, 94, 0.10);
        color: #86EFAC;
        border: 1px solid rgba(34, 197, 94, 0.30);
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 18px;
        font-size: .92rem;
    }

    /* Statistics */

    .stats {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .stat {
        flex: 1;
        min-width: 140px;
        background: rgba(17, 17, 27, 0.92);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 16px 18px;
        transition: .2s ease;
    }

    .stat:hover {
        background: var(--card-hover);
        border-color: rgba(124, 58, 237, 0.5);
        transform: translateY(-2px);
    }

    .stat .num {
        font-size: 1.6rem;
        font-weight: 700;
        color: #FFFFFF;
    }

    .stat .label {
        color: var(--muted);
        font-size: .82rem;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    /* Table */

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        text-align: left;
        padding: 12px 10px;
        border-bottom: 1px solid var(--border);
        font-size: .92rem;
    }

    th {
        color: var(--muted);
        text-transform: uppercase;
        font-size: .75rem;
        letter-spacing: .4px;
    }

    td {
        color: #E2E8F0;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:hover td {
        background: rgba(124, 58, 237, 0.04);
    }

    /* Status Badges */

    .badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: .78rem;
        font-weight: 600;
    }

    .badge-pending {
        background: rgba(245, 158, 11, 0.12);
        color: #FBBF24;
        border: 1px solid rgba(245, 158, 11, 0.25);
    }

    .badge-completed {
        background: rgba(34, 197, 94, 0.12);
        color: #4ADE80;
        border: 1px solid rgba(34, 197, 94, 0.25);
    }

    .overdue {
        color: var(--danger);
        font-weight: 600;
    }

    /* Actions */

    .actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .actions form {
        display: inline;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 7px;
        font-size: .82rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-weight: 600;
        transition: .2s ease;
    }

    .btn-edit {
        background: rgba(79, 70, 229, 0.15);
        color: #A5B4FC;
        border: 1px solid rgba(79, 70, 229, 0.25);
    }

    .btn-edit:hover {
        background: rgba(79, 70, 229, 0.25);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.12);
        color: #F87171;
        border: 1px solid rgba(239, 68, 68, 0.25);
    }

    .btn-delete:hover {
        background: rgba(239, 68, 68, 0.22);
    }

    .btn-toggle {
        background: rgba(148, 163, 184, 0.10);
        color: var(--muted);
        border: 1px solid var(--border);
    }

    .btn-toggle:hover {
        background: rgba(148, 163, 184, 0.18);
    }

    /* Filters */

    .filters {
        margin-bottom: 16px;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .filters a {
        padding: 6px 14px;
        border-radius: 999px;
        font-size: .85rem;
        text-decoration: none;
        color: var(--muted);
        border: 1px solid var(--border);
        background: rgba(17, 17, 27, 0.7);
        transition: .2s ease;
    }

    .filters a:hover {
        border-color: var(--primary);
        color: #C4B5FD;
    }

    .filters a.active {
        background: linear-gradient(
            135deg,
            var(--primary),
            var(--primary-dark)
        );
        color: #fff;
        border-color: transparent;
    }

    /* Empty State */

    .empty {
        text-align: center;
        color: var(--muted);
        padding: 40px 0;
    }

    /* Forms */

    label {
        display: block;
        color: #E2E8F0;
        font-size: .85rem;
        font-weight: 600;
        margin-bottom: 6px;
    }

    input[type="text"],
    input[type="date"],
    textarea,
    select {
        width: 100%;
        padding: 10px 12px;
        background: #0F0F17;
        color: var(--text);
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: .92rem;
        margin-bottom: 16px;
        font-family: inherit;
        outline: none;
        transition: .2s ease;
    }

    input[type="text"]:focus,
    input[type="date"]:focus,
    textarea:focus,
    select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }

    input::placeholder,
    textarea::placeholder {
        color: #64748B;
    }

    /* Form Actions */

    .form-actions {
        display: flex;
        gap: 10px;
    }

    .btn-primary {
        background: linear-gradient(
            135deg,
            var(--primary),
            var(--primary-dark)
        );
        color: #fff;
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        transition: .2s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
    }

    .btn-secondary {
        background: #1E1E2A;
        color: var(--text);
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        border: 1px solid var(--border);
        transition: .2s ease;
    }

    .btn-secondary:hover {
        background: #27273A;
    }

    /* Error */

    .error-text {
        color: #F87171;
        font-size: .8rem;
        margin-top: -10px;
        margin-bottom: 12px;
    }

</style>
```

</head>
<body>
    <nav>
        <span class="brand">📋 Task Manager</span>
        <a class="btn-new" href="{{ route('tasks.create') }}">+ New Task</a>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>