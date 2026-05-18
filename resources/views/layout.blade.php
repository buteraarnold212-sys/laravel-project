<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'EduTrack') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        /* ══ Reset ══════════════════════════════════════ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
        }

        /* ══ Navbar ═════════════════════════════════════ */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 66px;
            padding: 0 2.5rem;
            background: #0f172a;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            box-shadow: 0 4px 20px rgba(0,0,0,0.35);
            gap: 2rem;
        }

        /* Brand */
        .navbar__brand {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            flex-shrink: 0;
        }

        .navbar__brand i {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%);
            border-radius: 10px;
            font-size: 1.05rem;
            color: #fff;
            box-shadow: 0 4px 12px rgba(59,130,246,0.55);
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }

        .navbar__brand:hover i {
            transform: rotate(-8deg) scale(1.08);
        }

        .navbar__brand span {
            font-size: 1.2rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.4px;
            white-space: nowrap;
        }

        /* Center links */
        .navbar__center {
            display: flex;
            align-items: center;
            gap: 0.15rem;
            flex: 1;
            justify-content: center;
        }

        .navlink {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.52rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(255,255,255,0.48);
            text-decoration: none;
            transition: all 0.17s ease;
            white-space: nowrap;
            position: relative;
        }

        .navlink i {
            font-size: 0.9rem;
            transition: transform 0.17s ease;
        }

        .navlink:hover {
            background: rgba(255,255,255,0.07);
            color: rgba(255,255,255,0.92);
        }

        .navlink:hover i {
            transform: scale(1.15);
        }

        .navlink--active {
            background: rgba(59,130,246,0.2);
            color: #93c5fd;
            font-weight: 700;
        }

        .navlink--active i {
            color: #60a5fa;
        }

        .navlink--active::after {
            content: '';
            position: absolute;
            bottom: 3px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 2.5px;
            background: #3b82f6;
            border-radius: 99px;
        }

        /* Right side */
        .navbar__right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        .navbar__avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: #fff;
            font-size: 0.73rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            letter-spacing: 0.5px;
            border: 2px solid rgba(255,255,255,0.12);
            box-shadow: 0 2px 8px rgba(29,78,216,0.4);
            transition: transform 0.17s ease, border-color 0.17s ease, box-shadow 0.17s ease;
        }

        .navbar__avatar:hover {
            transform: scale(1.1);
            border-color: rgba(255,255,255,0.35);
            box-shadow: 0 4px 14px rgba(29,78,216,0.55);
        }

        /* ══ Page Content ═══════════════════════════════ */
        .page {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2.25rem 2.5rem;
        }

        /* ══ Flash Messages ══════════════════════════════ */
        .flash {
            display: flex;
            align-items: flex-start;
            gap: 0.8rem;
            padding: 1rem 1.35rem;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 1.75rem;
            line-height: 1.6;
            animation: flashIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .flash i:first-child {
            font-size: 1.05rem;
            margin-top: 0.1rem;
            flex-shrink: 0;
        }

        /* Success */
        .flash--success {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            color: #166534;
            border: 1px solid #86efac;
        }

        .flash--success i { color: #22c55e; }

        /* Error */
        .flash--error {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            color: #991b1b;
            border: 1px solid #fca5a5;
            flex-direction: column;
            gap: 0.4rem;
        }

        .flash--error .flash__title {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-weight: 700;
        }

        .flash--error i { color: #ef4444; }

        .flash--error ul {
            margin-left: 1.6rem;
            font-weight: 600;
        }

        .flash--error ul li { margin-top: 0.2rem; }

        @keyframes flashIn {
            from { opacity: 0; transform: translateY(-12px) scale(0.98); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* ══ Scrollbar ══════════════════════════════════ */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* ══ Responsive ═════════════════════════════════ */
        @media (max-width: 860px) {
            .navbar {
                flex-wrap: wrap;
                height: auto;
                padding: 0.8rem 1.25rem;
                gap: 0.6rem;
            }

            .navbar__center {
                order: 3;
                width: 100%;
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 0.2rem;
                gap: 0.1rem;
                scrollbar-width: none;
            }

            .navbar__center::-webkit-scrollbar { display: none; }

            .navlink {
                font-size: 0.82rem;
                padding: 0.42rem 0.7rem;
            }

            .navlink--active::after { display: none; }

            .page { padding: 1.5rem 1.1rem; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="navbar__brand">
            <i class="fas fa-graduation-cap"></i>
            <span>EduTrack</span>
        </a>

        <div class="navbar__center">
            <a href="{{ route('home') }}" class="navlink {{ request()->routeIs('home') ? 'navlink--active' : '' }}">
                <i class="fas fa-house"></i>
                Dashboard
            </a>
            <a href="{{ route('students.index') }}" class="navlink {{ request()->routeIs('students.*') ? 'navlink--active' : '' }}">
                <i class="fas fa-user-graduate"></i>
                Students
            </a>
            <a href="{{ route('members.index') }}" class="navlink {{ request()->routeIs('members.*') ? 'navlink--active' : '' }}">
                <i class="fas fa-users"></i>
                Members
            </a>
            <a href="{{ route('books.index') }}" class="navlink {{ request()->routeIs('books.*') ? 'navlink--active' : '' }}">
                <i class="fas fa-book"></i>
                Books
            </a>
            <a href="{{ route('borrowings.index') }}" class="navlink {{ request()->routeIs('borrowings.*') ? 'navlink--active' : '' }}">
                <i class="fas fa-handshake"></i>
                Borrowings
            </a>
        </div>

        <div class="navbar__right">
            <div class="navbar__avatar" title="Admin">AD</div>
        </div>
    </nav>

    <main class="page">
        @if(session('success'))
            <div class="flash flash--success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="flash flash--error">
                <div class="flash__title">
                    <i class="fas fa-exclamation-circle"></i>
                    Please fix the following errors:
                </div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>