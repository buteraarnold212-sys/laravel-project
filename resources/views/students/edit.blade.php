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
        max-width: 760px;
        margin: 0 auto;
    }

    /* ── Back Link ────────────────────────────────────── */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: #6b7280;
        font-size: 0.88rem;
        font-weight: 500;
        text-decoration: none;
        margin-bottom: 1.25rem;
        transition: color 0.15s ease;
    }

    .back-link:hover { color: #1d4ed8; }

    /* ── Form Card ────────────────────────────────────── */
    .form-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(0, 0, 0, 0.07);
        overflow: hidden;
    }

    /* ── Form Header ──────────────────────────────────── */
    .form-card__header {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 60%, #60a5fa 100%);
        padding: 1.75rem 2rem;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .form-card__header::before {
        content: '';
        position: absolute;
        top: -30px; right: -30px;
        width: 140px; height: 140px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }

    .form-card__header::after {
        content: '';
        position: absolute;
        bottom: -50px; right: 100px;
        width: 100px; height: 100px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }

    .form-card__icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 54px;
        height: 54px;
        min-width: 54px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        font-size: 1.35rem;
        border: 2px solid rgba(255,255,255,0.3);
        z-index: 1;
    }

    .form-card__header-body { z-index: 1; }

    .form-card__title {
        font-size: 1.35rem;
        font-weight: 700;
        letter-spacing: -0.2px;
        margin-bottom: 0.2rem;
    }

    .form-card__subtitle {
        font-size: 0.88rem;
        opacity: 0.85;
        line-height: 1.4;
    }

    /* ── Form Body ────────────────────────────────────── */
    .form-card__body { padding: 2rem; }

    /* ── Section Label ────────────────────────────────── */
    .form-section {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #9ca3af;
        padding-bottom: 0.6rem;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .form-section i { color: #93c5fd; }

    /* ── Form Grid ────────────────────────────────────── */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.25rem;
    }

    /* ── Form Group ───────────────────────────────────── */
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .form-group--full { grid-column: 1 / -1; }

    .form-label {
        font-size: 0.82rem;
        font-weight: 700;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-label .required {
        color: #ef4444;
        margin-left: 2px;
    }

    /* ── Input with Icon ──────────────────────────────── */
    .input-wrapper { position: relative; }

    .input-wrapper .input-icon {
        position: absolute;
        left: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 0.88rem;
        pointer-events: none;
        transition: color 0.15s ease;
    }

    .input-wrapper input {
        width: 100%;
        padding: 0.72rem 0.85rem 0.72rem 2.5rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 9px;
        font-size: 0.92rem;
        color: #111827;
        background: #f9fafb;
        transition: border-color 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        outline: none;
        font-family: inherit;
    }

    .input-wrapper input:focus {
        border-color: #3b82f6;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
    }

    .input-wrapper input:focus ~ .input-icon { color: #3b82f6; }

    .input-wrapper input.is-invalid { border-color: #ef4444; }

    .input-wrapper input.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
    }

    .input-wrapper input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0.5;
        cursor: pointer;
    }

    /* Error */
    .field-error {
        font-size: 0.8rem;
        color: #ef4444;
        display: flex;
        align-items: center;
        gap: 0.3rem;
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

    /* ── Buttons ──────────────────────────────────────── */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.65rem 1.4rem;
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

    .btn--secondary {
        background: #e0e7ff;
        color: #3730a3;
    }

    .btn--secondary:hover {
        background: #c7d2fe;
        transform: translateY(-1px);
    }

    /* ── Responsive ───────────────────────────────────── */
    @media (max-width: 640px) {
        .form-card__body { padding: 1.25rem; }
        .form-card__header { padding: 1.25rem; }
        .form-actions {
            flex-direction: column;
            align-items: stretch;
        }
        .form-actions .btn { justify-content: center; }
    }
</style>

    @php
        $fields = [
            ['type'=>'text','name'=>'name','id'=>'name','label'=>'Name','iconClass'=>'fas fa-user','value'=>$student->name,'required'=>true],
            ['type'=>'email','name'=>'email','id'=>'email','label'=>'Email','iconClass'=>'fas fa-envelope','value'=>$student->email,'required'=>true],
            ['type'=>'text','name'=>'phone','id'=>'phone','label'=>'Phone','iconClass'=>'fas fa-phone','value'=>$student->phone,'required'=>true],
            ['type'=>'text','name'=>'address','id'=>'address','label'=>'Address','iconClass'=>'fas fa-map-marker-alt','value'=>$student->address,'required'=>true],
            ['type'=>'text','name'=>'grade','id'=>'grade','label'=>'Grade','iconClass'=>'fas fa-graduation-cap','value'=>$student->grade,'required'=>true],
            ['type'=>'date','name'=>'enrollment_date','id'=>'enrollment_date','label'=>'Enrollment Date','iconClass'=>'fas fa-calendar','value'=>$student->enrollment_date,'required'=>true],
        ];
    @endphp

    <div class="form-page">

        <a href="{{ route('students.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Back to Students
        </a>

        <div class="form-card">
            <div class="form-card__header">
                <div class="form-card__icon">
                    <i class="fas fa-user-edit"></i>
                </div>
                <div class="form-card__header-body">
                    <h1 class="form-card__title">Edit Student</h1>
                    <p class="form-card__subtitle">Update student profile details and enrollment date.</p>
                </div>
            </div>

            <div class="form-card__body">
                <form action="{{ route('students.update', $student) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <p class="form-section"><i class="fas fa-id-card"></i> Personal Information</p>

                    <div class="form-grid">
                        @foreach($fields as $field)
                            <div class="form-group {{ $field['name'] === 'address' ? 'form-group--full' : '' }}">
                                <label class="form-label" for="{{ $field['id'] }}">
                                    {{ $field['label'] }}
                                    @if(!empty($field['required']))<span class="required">*</span>@endif
                                </label>
                                <div class="input-wrapper">
                                    <input
                                        type="{{ $field['type'] }}"
                                        name="{{ $field['name'] }}"
                                        id="{{ $field['id'] }}"
                                        value="{{ old($field['name'], $field['value']) }}"
                                        {{ !empty($field['required']) ? 'required' : '' }}
                                        class="{{ $errors->has($field['name']) ? 'is-invalid' : '' }}"
                                    >
                                    <i class="{{ $field['iconClass'] }} input-icon"></i>
                                </div>
                                @error($field['name'])
                                    <span class="field-error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        @endforeach
                    </div>

                    <div class="form-divider"></div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn--primary">
                            <i class="fas fa-save"></i>
                            Update Student
                        </button>
                        <a href="{{ route('students.index') }}" class="btn btn--secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection