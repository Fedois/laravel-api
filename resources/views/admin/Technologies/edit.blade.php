@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('admin.technologies.index') }}" class="btn btn-secondary my-1">Torna indietro</a>

            <form action="{{ route('admin.technologies.update', $technology->id) }}" method="POST">
                @csrf
                @method('PUT')

               @include('partials.errors')

                <div class="my-3">
                    <label for="name" class="form-label">Nome*</label>
                    <input required type="text" class="form-control" id="name" name="name" placeholder="aggiungi nome..." value="{{ $technology->name, old('name') }}">
                </div>
    
                <button type="submit" class="btn btn-primary">Modifica</button>
            </form>
    </div>
@endsection