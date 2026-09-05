@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h3>Edit book</h3>

    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('storage/images/'.$book->cover_photo) }}"
                alt="{{ $book->title }}" class="w-100">
        </div>

        <div class="col-md-8">
            <form action="{{ route('book.update', $book->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title"
                           value="{{ old('title', $book->title) }}" class="form-control"autofocus>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="year_published" class="form-label">Year Published</label>
                        <input type="number" name="year_published" id="year_published"
                               value="{{ old('year_published', $book->year_published) }}"
                               class="form-control">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="author_id" class="form-label">Author</label>

                        <select name="author_id" id="author_id" class="form-select">
                            <option value="" @selected(old('author_id', $book->author_id) === null)>
                                ANONYMOUS
                            </option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}"
                                @selected(old('author_id', $book->author_id) == $author->id)>
                                    {{ $author->name }} 
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="cover_photo" class="form-label">
                        Cover Photo (optional)
                    </label>

                    <input type="file" name="cover_photo" id="cover_photo" class="form-control">
                    <div class="form-text">
                        Acceptable formats: jpeg, jpg, png, gif only
                        <br>
                        Maximum file size: 6144KB
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-6">
                      <a href="{{ route('book.index') }}"
                          class="btn btn-secondary w-100">
                        Cancel
                      </a>
                      
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-warning w-100">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection