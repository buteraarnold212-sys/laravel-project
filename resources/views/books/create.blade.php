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
        max-width: 680px;
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

    /* ── Card Inner Banner ────────────────────────────── */
    .card::before {
        content: '';
        display: block;
        height: 5px;
        background: linear-gradient(90deg, #1d4ed8, #60a5fa);
    }

    /* ── Card Body Padding ────────────────────────────── */
    .card form {
        padding: 2rem;
    }

    /* ── Form Grid ────────────────────────────────────── */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.25rem;
        margin-bottom: 0;
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

    .field input {
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
    }

    .field input:focus {
        border-color: #3b82f6;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
    }

    .field input:invalid:not(:placeholder-shown) {
        border-color: #ef4444;
    }

    .field input[type="number"]::-webkit-inner-spin-button,
    .field input[type="number"]::-webkit-outer-spin-button {
        opacity: 1;
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
                    <i class="fas fa-book-medical"></i>
                    Add Book
                </div>
                <div class="page-header__subtitle">Add new library titles with author details and inventory count.</div>
            </div>
            <div class="page-actions">
                <a href="{{ route('books.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Back to Books
                </a>
            </div>
        </div>

        <div class="card">
            <form action="{{ route('books.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <div class="field">
                        <label for="title"><i class="fas fa-book"></i> Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. The Great Gatsby" required />
                    </div>

                    <div class="field">
                        <label for="author"><i class="fas fa-pen-fancy"></i> Author</label>
                        <input type="text" id="author" name="author" value="{{ old('author') }}" placeholder="e.g. F. Scott Fitzgerald" required />
                    </div>

                    <div class="field">
                        <label for="quantity"><i class="fas fa-boxes"></i> Quantity</label>
                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="0" required />
                    </div>
                </div>

                <div class="form-divider"></div>

                <div class="form-actions">
                    <button type="submit" class="btn btn--primary">
                        <i class="fas fa-save"></i>
                        Save Book
                    </button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>

    </div>

@endsection