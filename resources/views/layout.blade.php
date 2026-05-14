<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2c3e50;
            --primary-light: #34495e;
            --accent: #16a085;
            --accent-light: #1abc9c;
            --danger: #e74c3c;
            --danger-light: #ec7063;
            --success: #27ae60;
            --warning: #f39c12;
            --bg: #ecf0f1;
            --bg-light: #ffffff;
            --text: #2c3e50;
            --text-light: #7f8c8d;
            --border: #bdc3c7;
            --border-light: #e8eaed;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background-color: var(--bg);
            min-height: 100vh;
            padding: 20px;
            color: var(--text);
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: var(--bg-light);
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08), 0 2px 6px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        header {
            background-color: var(--primary);
            color: white;
            padding: 35px 30px;
            border-bottom: 3px solid var(--accent);
        }

        header h1 {
            font-size: 2.2em;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        nav {
            background-color: #ffffff;
            padding: 0;
            display: flex;
            gap: 0;
            border-bottom: 1px solid var(--border-light);
        }

        nav a {
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95em;
            transition: all 0.2s ease;
            padding: 16px 24px;
            border-bottom: 3px solid transparent;
            flex: 1;
            text-align: center;
        }

        nav a:hover {
            background-color: #f5f7fa;
            border-bottom-color: var(--accent);
            color: var(--accent);
        }

        main {
            padding: 35px 30px;
        }

        h2 {
            color: var(--primary);
            margin-bottom: 25px;
            font-size: 1.8em;
            font-weight: 600;
        }

        .success {
            background-color: #d5f4e6;
            color: #0b5345;
            padding: 14px 16px;
            border-radius: 4px;
            margin-bottom: 20px;
            border-left: 4px solid var(--success);
            font-size: 0.95em;
        }

        .error {
            background-color: #fadbd8;
            color: #78281f;
            padding: 14px 16px;
            border-radius: 4px;
            margin-bottom: 20px;
            border-left: 4px solid var(--danger);
        }

        .error ul {
            margin-left: 20px;
            margin-top: 10px;
        }

        .error li {
            margin: 6px 0;
            font-size: 0.95em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        th {
            background-color: var(--primary);
            color: white;
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 0.85em;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border: none;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-light);
            font-size: 0.95em;
        }

        tr {
            transition: background-color 0.15s ease;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .actions a, .actions button {
            padding: 7px 12px;
            border-radius: 4px;
            font-size: 0.85em;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            font-weight: 500;
        }

        .actions a {
            background-color: var(--accent);
            color: white;
        }

        .actions a:hover {
            background-color: var(--primary-light);
            box-shadow: 0 2px 4px rgba(44, 62, 80, 0.15);
        }

        .actions button {
            background-color: var(--danger);
            color: white;
        }

        .actions button:hover {
            background-color: #c0392b;
            box-shadow: 0 2px 4px rgba(231, 76, 60, 0.15);
        }

        .btn-add {
            display: inline-block;
            background-color: var(--accent);
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            font-size: 0.95em;
        }

        .btn-add:hover {
            background-color: var(--primary-light);
            box-shadow: 0 2px 4px rgba(44, 62, 80, 0.15);
        }

        form {
            background-color: #f9fafb;
            padding: 28px;
            border-radius: 6px;
            max-width: 550px;
            margin: 20px 0;
            border: 1px solid var(--border-light);
        }

        label {
            display: block;
            margin-top: 16px;
            margin-bottom: 7px;
            font-weight: 500;
            color: var(--text);
            font-size: 0.9em;
        }

        input, select {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 0;
            border: 1px solid var(--border);
            border-radius: 4px;
            font-size: 0.95em;
            transition: all 0.2s ease;
            font-family: inherit;
            background-color: white;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(22, 160, 133, 0.1);
            background-color: white;
        }

        button {
            margin-top: 18px;
            padding: 11px 28px;
            background-color: var(--accent);
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            font-size: 0.95em;
            transition: all 0.2s ease;
            width: 100%;
        }

        button:hover {
            background-color: var(--primary-light);
            box-shadow: 0 2px 4px rgba(44, 62, 80, 0.15);
        }

        button:active {
            transform: translateY(0);
        }

        p {
            color: var(--text-light);
            line-height: 1.6;
            margin: 15px 0;
            font-size: 0.95em;
        }

        ul {
            margin-left: 20px;
            line-height: 1.7;
        }

        li {
            margin: 8px 0;
            font-size: 0.95em;
        }

        li a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        li a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        i {
            margin-right: 6px;
            display: inline-block;
            min-width: 1em;
        }

        nav a i {
            margin-right: 8px;
        }

        .success i, .error i {
            margin-right: 8px;
        }

        label i {
            color: var(--accent);
            margin-right: 8px;
        }

        th i {
            margin-right: 6px;
            opacity: 0.9;
        }

        h2 i {
            margin-right: 10px;
            color: var(--accent);
        }

        button i, .btn-add i {
            margin-right: 8px;
        }

        .actions i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-book"></i> Library Management System</h1>
        </header>

        <nav>
            <a href="{{ route('members.index') }}"><i class="fas fa-users"></i> Members</a>
            <a href="{{ route('books.index') }}"><i class="fas fa-book-open"></i> Books</a>
            <a href="{{ route('borrowings.index') }}"><i class="fas fa-sync-alt"></i> Borrowings</a>
        </nav>

        <main>
            @if(session('success'))
                <div class="success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="error">
                    <strong><i class="fas fa-exclamation-circle"></i> Please fix the following errors:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
