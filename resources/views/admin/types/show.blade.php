@extends('layouts.admin')

@section('content')
    <div class="container mt-3">
        @include('partials.success')

        <a href="{{ route('admin.types.index') }}" class="btn btn-secondary mb-3">torna indietro</a>

        <h1>{{ $type->name }}</h1> 
        <span>slug: {{ $type->slug }}</span>

        <h3 class="my-4">progetti totali: {{ $type->projects()->count() }}</h3>

        <ul>
            @if($type->projects)
                @foreach ($type->projects as $project)
                    <li>
                        <a href="{{ route('admin.projects.show', $project->id) }}">{{ $project->title }}</a>
                    </li>
                @endforeach
            @endif
        </ul>

        <a href="{{ route('admin.types.edit', $type->id) }}" class="btn btn-warning">Modifica</a>

        <form action="{{ route('admin.types.destroy', $type->id) }}" class="d-inline-block" method="POST">
            @csrf
            @method('DELETE')
            
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                elimina
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">conferma eliminazione</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            sei sicuro di voler eliminare??
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">no</button>
                            <button type="submit" class="btn btn-primary">Salva</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection