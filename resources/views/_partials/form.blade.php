{{--
  Shared form layout matching home.blade.php feel.
  Usage:
    @include('_partials.form', [
      'iconClass' => 'fas fa-user-plus',
      'title' => 'Add Student',
      'subtitle' => '...',
      'backUrl' => route('students.index'),
      'backLabel' => 'Back',
      'actionRoute' => route('students.store'),
      'method' => 'POST', // or PUT
      'methodField' => 'PUT', // optional for PUT/PATCH
    ])
--}}

@php
    $iconClass = $iconClass ?? '';
    $title = $title ?? '';
    $subtitle = $subtitle ?? '';
    $backUrl = $backUrl ?? '#';
    $backLabel = $backLabel ?? 'Back';
    $actionRoute = $actionRoute ?? '#';
    $method = $method ?? 'POST';
    $methodField = $methodField ?? null;
@endphp

<div class="welcome-card">
    <div class="welcome-card__icon">
        <i class="{{ $iconClass }}"></i>
    </div>
    <div class="welcome-card__body">
        <h1 class="welcome-card__title">{{ $title }}</h1>
        @if($subtitle)
            <p class="welcome-card__subtitle">{{ $subtitle }}</p>
        @endif
        <a href="{{ $backUrl }}" class="btn btn--primary">
            <i class="fas fa-arrow-left"></i>
            {{ $backLabel }}
        </a>
    </div>
</div>

<div class="table-container" style="padding: 1.5rem;">
    <form action="{{ $actionRoute }}" method="POST">
        @csrf
        @if($methodField)
            @method($methodField)
        @endif

        {{ $slot ?? '' }}
    </form>
</div>

