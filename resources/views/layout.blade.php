<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        a { color: #1a73e8; text-decoration: none; }
        .actions a { margin-right: 10px; }
        form { max-width: 600px; }
        label { display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 8px; margin-top: 4px; box-sizing: border-box; }
        button { margin-top: 12px; padding: 8px 14px; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Simple Library System</h1>
    <nav>
        <a href="{{ route('members.index') }}">Members</a> |
        <a href="{{ route('books.index') }}">Books</a> |
        <a href="{{ route('borrowings.index') }}">Borrowings</a>
    </nav>
    <hr>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</body>
</html>
