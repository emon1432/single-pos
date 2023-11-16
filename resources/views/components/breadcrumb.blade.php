@props([
    'page' => '',
])
<div class="pagetitle">
    <h3>{{ $page }}</h3>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $page }}</li>
        </ol>
    </nav>
</div>
