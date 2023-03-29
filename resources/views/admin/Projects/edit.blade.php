@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-secondary my-1">Torna indietro</a>

            <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

               @include('partials.errors')

                <div class="my-3">
                    <label for="title" class="form-label">Titolo*</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}">
                </div>
                
                <div class="my-3">
                    <label for="content" class="form-label">Contenuto*</label>
                    <textarea class="form-control" id="content" name="content" rows="3">{{ $project->content }}</textarea>
                </div>

                <div class="my-3">
                    <label for="type_id" class="form-label">Tipo</label>
                    <select name="type_id" id="type_id">
                        <option value="">nessun tipo</option>

                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>
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

                            @if (old('technologies') && is_array(old('technologies')) && count(old('technologies')) > 0)
                                {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}
                            @elseif($project->technologies->contains($technology))
                                checked
                            @endif
                            value="{{ $technology->id }}">
                            
                            <label for="tech-{{ $technology->id }}" class="pe-3">
                                {{ $technology->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                @if ($project->img)
                    <div>
                        <img class="h-50 w-50" src="{{ asset('storage/'. $project->img) }}" alt="">
                        <div class="form-check form-switch d-inline-block ms-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="deleteImg" name="deleteImg">
                            <label class="form-check-label" for="deleteImg">elimina immagine</label>
                        </div>
                    </div>
                @endif

                <div class="my-3">
                    <label for="img" class="form-label">Immagine</label>
                    <input type="file" class="form-control" id="img" name="img" accept="image/*">
                </div>
    
                <button type="submit" class="btn btn-primary">Modifica</button>
            </form>
    </div>
@endsection