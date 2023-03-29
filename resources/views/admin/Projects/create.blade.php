@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary my-1">Torna indietro</a>

            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

               @include('partials.errors')

                <div class="my-3">
                    <label for="title" class="form-label">Titolo*</label>
                    <input required type="text" class="form-control" id="title" name="title" placeholder="aggiungi titolo..." value="{{ old('title') }}">
                </div>
                
                <div class="my-3">
                    <label for="content" class="form-label">Contenuto*</label>
                    <textarea required class="form-control" id="content" name="content" rows="3">{{ old('content') }}</textarea>
                </div>

                <div class="my-3">
                    <label for="type_id" class="form-label">Tipo</label>
                    <select name="type_id" id="type_id">
                        <option value="">nessun tipo</option>

                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="my-3">
                    <label for="content" class="form-label">Tecnologie</label>
                    <div>
                        @foreach ($technologies as $technology)
                            <input type="checkbox" 
                            id="tech-{{ $technology->id }}" 
                            name="technologies[]" 
                            {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}
                            value="{{ $technology->id }}">
                            
                            <label for="tech-{{ $technology->id }}" class="pe-3">
                                {{ $technology->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="my-3">
                    <label for="img" class="form-label">Immagine</label>
                    <input type="file" class="form-control" id="img" name="img" placeholder="aggiungi immagine..." accept="image/*">
                </div>
    
                <button type="submit" class="btn btn-primary">Crea</button>
            </form>
    </div>
@endsection