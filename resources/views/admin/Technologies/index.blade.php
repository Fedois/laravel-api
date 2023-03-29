@extends('layouts.admin')

@section('content')
<div class="container all-projects">
    
    <h1 class="my-3">Tutte le tecnologie</h1>

    <a href="{{ route('admin.technologies.create') }}" class="btn btn-primary my-2">Nuova tecnologia</a>

    @include('partials.success')

    <ul class="list-group">
        @foreach ($technologies as $technology)
            <li class="my-1 list-group-item list-group-item-action">
                <a href="{{ route('admin.technologies.show', $technology->id) }}" class="text-dark text-decoration-none">

                    <span class="me-5">{{ $technology->id }}</span>  {{ $technology->name }}

                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection