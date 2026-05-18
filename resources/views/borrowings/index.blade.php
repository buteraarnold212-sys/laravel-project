@extends('layout')

@section('content')

<style>
    /* ── Reset & Base ─────────────────────────────────── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        background: #f0f4f8;
        color: #1e293b;
    }

    /* ── Welcome Card ─────────────────────────────────── */
    .welcome-card {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 60%, #60a5fa 100%);
        border-radius: 16px;
        padding: 2rem 2.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 30px rgba(29, 78, 216, 0.25);
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .welcome-card::after {
        content: '';
        position: absolute;
        bottom: -60px;
        right: 80px;
        width: 140px;
        height: 140px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .welcome-card__icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        min-width: 70px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        font-size: 1.8rem;
        backdrop-filter: blur(4px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        z-index: 1;
    }

    .welcome-card__body {
        z-index: 1;
    }

    .welcome-card__title {
        font-size: 1.75rem;
        font-weight: 700;
        letter-spacing: -0.3px;
        margin-bottom: 0.4rem;
    }

    .welcome-card__subtitle {
        font-size: 0.95rem;
        opacity: 0.85;
        line-height: 1.5;
        margin-bottom: 1.25rem;
        max-width: 500px;
    }

    /* ── Buttons ──────────────────────────────────────── */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.18s ease;
        border: none;
        line-height: 1;
        font-family: inherit;
    }

    .btn--primary {
        background: #fff;
        color: #1d4ed8;
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    }

    .btn--primary:hover {
        background: #eff6ff;
        box-shadow: 0 4px 14px rgba(0,0,0,0.15);
        transform: translateY(-1px);
    }

    .btn--secondary {
        background: #e0e7ff;
        color: #3730a3;
    }

    .btn--secondary:hover {
        background: #c7d2fe;
        transform: translateY(-1px);
    }

    .btn--danger {
        background: #fee2e2;
        color: #b91c1c;
        cursor: pointer;
    }

    .btn--danger:hover {
        background: #fecaca;
        transform: translateY(-1px);
    }

    /* ── Table Container ──────────────────────────────── */
    .table-container {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(0, 0, 0, 0.07);
        overflow: hidden;
    }

    /* ── Table Header ─────────────────────────────────── */
    .table-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.25rem 1.75rem;
        border-bottom: 1px solid #e5e7eb;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .table-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
    }

    .table-header__right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    /* ── Empty State ──────────────────────────────────── */
    .empty-state {
        padding: 3rem 2rem;
        text-align: center;
    }

    .empty-state__icon {
        font-size: 2.5rem;
        opacity: 0.3;
        display: block;
        margin-bottom: 0.75rem;
        color: #6b7280;
    }

    .empty-state__heading {
        color: #374151;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }

    .empty-state__sub {
        color: #9ca3af;
        margin-bottom: 1.25rem;
        font-size: 0.9rem;
    }

    /* ── Table ────────────────────────────────────────── */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }

    thead tr {
        background: #f8fafc;
    }

    th {
        padding: 0.85rem 1.25rem;
        text-align: left;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #6b7280;
        border-bottom: 1px solid #e5e7eb;
    }

    tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.13s ease;
    }

    tbody tr:last-child {
        border-bottom: none;
    }

    tbody tr:hover {
        background: #f0f9ff;
    }

    td {
        padding: 0.9rem 1.25rem;
        color: #374151;
        vertical-align: middle;
    }

    td strong {
        color: #111827;
    }

    /* Borrowing ID badge */
    td:first-child strong {
        display: inline-block;
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 6px;
        padding: 0.2rem 0.55rem;
        font-size: 0.82rem;
        font-weight: 700;
    }

    /* Date styling */
    .date-text {
        color: #374151;
        font-size: 0.88rem;
    }

    .date-pending {
        color: #9ca3af;
        font-style: italic;
        font-size: 0.88rem;
    }

    /* Status badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.28rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        white-space: nowrap;
    }

    .status-badge--returned {
        background: #f0fdf4;
        color: #16a34a;
    }

    .status-badge--active {
        background: #fffbeb;
        color: #d97706;
    }

    .status-badge .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
        display: inline-block;
    }

    /* Actions column */
    .actions-cell {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    /* ── Responsive ───────────────────────────────────── */
    @media (max-width: 768px) {
        .welcome-card {
            flex-direction: column;
            text-align: center;
            padding: 1.5rem;
        }

        .welcome-card__subtitle {
            max-width: 100%;
        }

        .table-header {
            flex-direction: column;
            align-items: flex-start;
        }

        table, thead, tbody, th, td, tr {
            display: block;
        }

        thead tr {
            display: none;
        }

        tbody tr {
            margin-bottom: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 0.75rem;
        }

        td {
            padding: 0.4rem 0.5rem;
        }

        td::before {
            content: attr(data-label) ': ';
            font-weight: 600;
            color: #6b7280;
            font-size: 0.78rem;
            display: block;
        }
    }
</style>

    <div class="welcome-card">
        <div class="welcome-card__icon">
            <i class="fas fa-handshake"></i>
        </div>
        <div class="welcome-card__body">
            <h1 class="welcome-card__title">Borrowing Records</h1>
            <p class="welcome-card__subtitle">Track issued books, manage due dates, and maintain a complete borrowing history for your library.</p>
            <a href="{{ route('borrowings.create') }}" class="btn btn--primary">
                <i class="fas fa-plus"></i>
                New Borrowing
            </a>
        </div>
    </div>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Borrowing Transactions</h2>
            <div class="table-header__right">
                <a href="{{ route('borrowings.create') }}" class="btn btn--secondary">
                    <i class="fas fa-plus"></i>
                    New Borrowing
                </a>
            </div>
        </div>

        @if($borrowings->isEmpty())
            <div class="empty-state">
                <i class="fas fa-inbox empty-state__icon"></i>
                <p class="empty-state__heading">No borrowing records</p>
                <p class="empty-state__sub">Start by recording your first book borrowing</p>
                <a href="{{ route('borrowings.create') }}" class="btn btn--primary">
                    <i class="fas fa-plus"></i>
                    Record First Borrowing
                </a>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Member</th>
                        <th>Book</th>
                        <th>Borrowed Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowings as $borrowing)
                        <tr>
                            <td data-label="ID"><strong>#{{ $borrowing->id }}</strong></td>
                            <td data-label="Member"><strong>{{ $borrowing->member->name ?? 'Unknown' }}</strong></td>
                            <td data-label="Book">{{ $borrowing->book->title ?? 'Unknown' }}</td>
                            <td data-label="Borrowed Date">
                                <span class="date-text">{{ $borrowing->borrowing_date }}</span>
                            </td>
                            <td data-label="Return Date">
                                @if($borrowing->return_date)
                                    <span class="date-text">{{ $borrowing->return_date }}</span>
                                @else
                                    <span class="date-pending">Pending</span>
                                @endif
                            </td>
                            <td data-label="Status">
                                @if($borrowing->return_date)
                                    <span class="status-badge status-badge--returned">
                                        <span class="dot"></span> Returned
                                    </span>
                                @else
                                    <span class="status-badge status-badge--active">
                                        <span class="dot"></span> Active
                                    </span>
                                @endif
                            </td>
                            <td data-label="Actions">
                                <div class="actions-cell">
                                    <a href="{{ route('borrowings.edit', $borrowing) }}" class="btn btn--secondary" style="padding:0.5rem 0.75rem; font-size:0.85rem;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('borrowings.destroy', $borrowing) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn--danger" style="padding:0.5rem 0.75rem; font-size:0.85rem;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection