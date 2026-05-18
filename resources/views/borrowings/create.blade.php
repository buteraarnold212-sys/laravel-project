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

    /* Date input icon color fix */
    .field input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0.5;
        cursor: pointer;
    }

    /* Disabled option style */
    .field select option:disabled {
        color: #9ca3af;
    }

    /* ── Section Label ────────────────────────────────── */
    .form-section-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #9ca3af;
        margin-bottom: 0.25rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #f1f5f9;
        grid-column: 1 / -1;
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

    /* ── Info note ────────────────────────────────────── */
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
        margin-top: 1rem;
        grid-column: 1 / -1;
    }

    .form-note i {
        color: #3b82f6;
        flex-shrink: 0;
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
                    <i class="fas fa-handshake"></i>
                    New Borrowing
                </div>
                <div class="page-header__subtitle">Record a new book loan and choose the member with the expected return date.</div>
            </div>
            <div class="page-actions">
                <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Back to Borrowings
                </a>
            </div>
        </div>

        <div class="card">
            <form action="{{ route('borrowings.store') }}" method="POST">
                @csrf

                <div class="form-grid">

                    <p class="form-section-label"><i class="fas fa-user"></i> &nbsp;Who is borrowing?</p>

                    <div class="field">
                        <label for="member_id"><i class="fas fa-user"></i> Member</label>
                        <div class="select-wrapper">
                            <select id="member_id" name="member_id" required>
                                <option value="">Select member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
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
                                        {{ old('book_id') == $book->id ? 'selected' : '' }}
                                        {{ $book->quantity < 1 ? 'disabled' : '' }}>
                                        {{ $book->title }}@if($book->quantity < 1) — Out of stock @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <p class="form-section-label"><i class="fas fa-calendar"></i> &nbsp;Dates</p>

                    <div class="field">
                        <label for="borrowing_date"><i class="fas fa-calendar"></i> Borrowing Date</label>
                        <input type="date" id="borrowing_date" name="borrowing_date" value="{{ old('borrowing_date') }}" required />
                    </div>

                    <div class="field">
                        <label for="return_date"><i class="fas fa-calendar-check"></i> Return Date <span style="color:#9ca3af; font-weight:400; text-transform:none; font-size:0.78rem;">(optional)</span></label>
                        <input type="date" id="return_date" name="return_date" value="{{ old('return_date') }}" />
                    </div>

                    <div class="form-note">
                        <i class="fas fa-info-circle"></i>
                        Leave the return date empty if the book hasn't been returned yet. You can fill it in later when editing.
                    </div>

                </div>

                <div class="form-divider"></div>

                <div class="form-actions">
                    <button type="submit" class="btn btn--primary">
                        <i class="fas fa-save"></i>
                        Save Borrowing
                    </button>
                    <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Cancel</a>
                </div>

            </form>
        </div>

    </div>

@endsection