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

    /* ── Page Wrapper ─────────────────────────────────── */
    .form-page {
        max-width: 720px;
        margin: 0 auto;
    }

    /* ── Page Header ──────────────────────────────────── */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .page-header__title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.25rem;
    }

    .page-header__title i {
        color: #3b82f6;
    }

    .page-header__subtitle {
        font-size: 0.9rem;
        color: #6b7280;
        line-height: 1.4;
    }

    /* ── Buttons ──────────────────────────────────────── */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.65rem 1.25rem;
        border-radius: 9px;
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
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
        color: #fff;
        box-shadow: 0 3px 10px rgba(29, 78, 216, 0.3);
    }

    .btn--primary:hover {
        box-shadow: 0 5px 16px rgba(29, 78, 216, 0.4);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #e0e7ff;
        color: #3730a3;
    }

    .btn-secondary:hover {
        background: #c7d2fe;
        transform: translateY(-1px);
    }

    /* ── Card ─────────────────────────────────────────── */
    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(0, 0, 0, 0.07);
        overflow: hidden;
    }

    .card::before {
        content: '';
        display: block;
        height: 5px;
        background: linear-gradient(90deg, #1d4ed8, #60a5fa);
    }

    .card form {
        padding: 2rem;
    }

    /* ── Form Grid ────────────────────────────────────── */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.25rem;
    }

    /* ── Field ────────────────────────────────────────── */
    .field {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .field label {
        font-size: 0.82rem;
        font-weight: 700;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .field label i {
        color: #3b82f6;
        font-size: 0.85rem;
    }

    /* ── Inputs & Selects ─────────────────────────────── */
    .field input,
    .field select {
        width: 100%;
        padding: 0.72rem 0.9rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 9px;
        font-size: 0.92rem;
        color: #111827;
        background: #f9fafb;
        transition: border-color 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        outline: none;
        font-family: inherit;
        appearance: none;
        -webkit-appearance: none;
    }

    .field input:focus,
    .field select:focus {
        border-color: #3b82f6;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
    }

    /* Custom select arrow */
    .select-wrapper {
        position: relative;
    }

    .select-wrapper select {
        padding-right: 2.5rem;
        cursor: pointer;
    }

    .select-wrapper::after {
        content: '\f078';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 0.75rem;
        color: #9ca3af;
        position: absolute;
        right: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .field input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0.5;
        cursor: pointer;
    }

    /* ── Section Label ────────────────────────────────── */
    .form-section-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #9ca3af;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #f1f5f9;
        grid-column: 1 / -1;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    /* ── Info Note ────────────────────────────────────── */
    .form-note {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 8px;
        padding: 0.65rem 1rem;
        font-size: 0.83rem;
        color: #1e40af;
        grid-column: 1 / -1;
    }

    .form-note i {
        color: #3b82f6;
        flex-shrink: 0;
    }

    /* ── Return date highlight ────────────────────────── */
    .field--highlight input {
        border-color: #6ee7b7;
        background: #f0fdf4;
    }

    .field--highlight input:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12);
        background: #fff;
    }

    .field--highlight label {
        color: #065f46;
    }

    .field--highlight label i {
        color: #10b981;
    }

    /* ── Divider ──────────────────────────────────────── */
    .form-divider {
        height: 1px;
        background: #f1f5f9;
        margin: 1.75rem 0;
    }

    /* ── Form Actions ─────────────────────────────────── */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-top: 1.75rem;
        flex-wrap: wrap;
    }

    /* ── Tabs ─────────────────────────────────────────── */
    .tabs {
        display: flex;
        gap: 0.6rem;
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
    }

    .tab-btn {
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #3730a3;
        padding: 0.65rem 0.95rem;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.16s ease;
    }

    .tab-btn:hover {
        background: #f8fafc;
        transform: translateY(-1px);
    }

    .tab-btn--active {
        border-color: rgba(59,130,246,0.6);
        background: rgba(59,130,246,0.12);
        color: #1d4ed8;
        box-shadow: 0 4px 12px rgba(29, 78, 216, 0.12);
    }

    .tab-panel {
        display: none;
    }

    .tab-panel--active {
        display: block;
    }

    /* ── Responsive ───────────────────────────────────── */
    @media (max-width: 560px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .card form {
            padding: 1.25rem;
        }

        .form-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .form-actions .btn {
            justify-content: center;
        }
    }
</style>

    <div class="form-page">

        <div class="page-header">
            <div>
                <div class="page-header__title">
                    <i class="fas fa-edit"></i>
                    Edit Borrowing
                </div>
                <div class="page-header__subtitle">Adjust the borrowing record or return date for this member's loan.</div>
            </div>
            <div class="page-actions">
                <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Back to Borrowings
                </a>
            </div>
        </div>

        <div class="card">
            <form action="{{ route('borrowings.update', $borrowing) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="tabs" role="tablist" aria-label="Borrowing actions">
                    <button type="button" class="tab-btn tab-btn--active" data-tab="tab-borrowing" role="tab" aria-selected="true">
                        <i class="fas fa-handshake"></i>
                        Borrowing
                    </button>
                    <button type="button" class="tab-btn" data-tab="tab-return" role="tab" aria-selected="false">
                        <i class="fas fa-undo-alt"></i>
                        Book Return
                    </button>
                </div>

                <div id="tab-borrowing" class="tab-panel tab-panel--active">
                    <div class="form-grid">

                        <p class="form-section-label"><i class="fas fa-user"></i> Who is borrowing?</p>

                        <div class="field">
                            <label for="member_id"><i class="fas fa-user"></i> Member</label>
                            <div class="select-wrapper">
                                <select id="member_id" name="member_id" required>
                                    <option value="">Select member</option>
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}" {{ old('member_id', $borrowing->member_id) == $member->id ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="field">
                            <label for="book_id"><i class="fas fa-book"></i> Book</label>
                            <div class="select-wrapper">
                                <select id="book_id" name="book_id" required>
                                    <option value="">Select book</option>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}"
                                            {{ old('book_id', $borrowing->book_id) == $book->id ? 'selected' : '' }}
                                            {{ $book->quantity < 1 && $book->id !== $borrowing->book_id ? 'disabled' : '' }}>
                                            {{ $book->title }}@if($book->quantity < 1 && $book->id !== $borrowing->book_id) — Out of stock @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <p class="form-section-label"><i class="fas fa-calendar"></i> Dates</p>

                        <div class="field">
                            <label for="borrowing_date"><i class="fas fa-calendar"></i> Borrowing Date</label>
                            <input type="date" id="borrowing_date" name="borrowing_date" value="{{ old('borrowing_date', $borrowing->borrowing_date) }}" required />
                        </div>

                    </div>
                </div>

                <div id="tab-return" class="tab-panel">
                    <div class="form-grid">

                        <p class="form-section-label"><i class="fas fa-calendar-check"></i> Return</p>

                        <div class="field field--highlight">
                            <label for="return_date">
                                <i class="fas fa-calendar-check"></i>
                                Return Date
                                <span style="color:#9ca3af; font-weight:400; text-transform:none; font-size:0.78rem; margin-left:0.25rem;">(optional)</span>
                            </label>
                            <input type="date" id="return_date" name="return_date" value="{{ old('return_date', $borrowing->return_date) }}" />
                        </div>

                        <div class="form-note">
                            <i class="fas fa-circle-info"></i>
                            Fill in the return date to mark this borrowing as returned. Leave it empty to keep it active.
                        </div>

                    </div>
                </div>

                <script>
                    (function () {
                        const tabButtons = document.querySelectorAll('[data-tab]');
                        const panels = document.querySelectorAll('.tab-panel');

                        function setActive(tabName) {
                            tabButtons.forEach(btn => {
                                const isActive = btn.getAttribute('data-tab') === tabName;
                                btn.classList.toggle('tab-btn--active', isActive);
                                btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
                            });

                            panels.forEach(panel => {
                                const isActive = panel.id === tabName;
                                panel.classList.toggle('tab-panel--active', isActive);
                            });
                        }

                        tabButtons.forEach(btn => {
                            btn.addEventListener('click', () => setActive(btn.getAttribute('data-tab')));
                        });
                    })();
                </script>

                <div class="form-divider"></div>

                <div class="form-actions">
                    <button type="submit" class="btn btn--primary">
                        <i class="fas fa-save"></i>
                        Update Borrowing
                    </button>
                    <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>

    </div>

@endsection