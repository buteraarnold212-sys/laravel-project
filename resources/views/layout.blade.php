<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        header h1 {
            font-size: 2.5em;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        nav {
            background: #f8f9fa;
            padding: 15px 30px;
            display: flex;
            gap: 30px;
            border-bottom: 2px solid #667eea;
        }

        nav a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1em;
            transition: all 0.3s ease;
            padding: 8px 15px;
            border-radius: 6px;
        }

        nav a:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        main {
            padding: 40px 30px;
        }

        h2 {
            color: #333;
            margin-bottom: 25px;
            font-size: 2em;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #28a745;
            font-weight: 500;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #dc3545;
        }

        .error ul {
            margin-left: 20px;
        }

        .error li {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 0.5px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        tr:hover {
            background: #f8f9fa;
            transition: background 0.2s ease;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .actions a, .actions button {
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 0.9em;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .actions a {
            background: #667eea;
            color: white;
        }

        .actions a:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .actions button {
            background: #dc3545;
            color: white;
        }

        .actions button:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        .btn-group {
            margin: 25px 0;
        }

        .btn-add {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1em;
        }

        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        form {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.95em;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 0;
            border: 2px solid #e9ecef;
            border-radius: 6px;
            font-size: 1em;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: white;
        }

        button {
            margin-top: 20px;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1em;
            transition: all 0.3s ease;
            width: 100%;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        p {
            color: #666;
            line-height: 1.6;
            margin: 15px 0;
            font-size: 1.05em;
        }

        ul {
            margin-left: 20px;
            line-height: 1.8;
        }

        li {
            margin: 8px 0;
        }

        li a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        li a:hover {
            color: #764ba2;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📚 Library Management System</h1>
        </header>

        <nav>
            <a href="{{ route('members.index') }}">👥 Members</a>
            <a href="{{ route('books.index') }}">📖 Books</a>
            <a href="{{ route('borrowings.index') }}">🔄 Borrowings</a>
        </nav>

        <main>
            @if(session('success'))
                <div class="success">✓ {{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="error">
                    <strong>❌ Please fix the following errors:</strong>
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
