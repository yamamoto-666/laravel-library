@extends('layouts.app')

@section('title')

@section('content')

    <div class="container">
        <h4 class="fw-bold">Add new book</h4>

        <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="title" class="label-control">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" autofocus required>
            @error('title')
                {{ $message }}
            @enderror


            <div class="row">
                <div class="col-md-6 mt-3">
                    <label for="date" class="label-control">Year Published</label>
                    <input type="number" name="year_published" value="{{ old('year_published') }}" class="form-control"
                        required placeholder="YYYY">
                    @error('year_published')
                        {{ $message}}
                    @enderror
                </div>
                <div class="col-md-6 mt-3">
                    <label for="name" class="label-control">Author</label>
                    <select name="author_id" class="form-select">
                        <option value="">ANONYMOUS</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" @selected(old('author_id') == $author->id)>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('author_id')
                        {{ $message }}
                    @enderror
                </div>
                <div class="col-md-6 mt-3">
                    <label for="file" class="label-control">Cover Photo (optional)</label>
                    <input type="file" name="cover_photo" class="form-control">
                    @error('cover_photo')
                        {{ $message }}
                    @enderror
                </div>
                <div class="col-md-6 mt-3">
                    <button type="submit" class="btn btn-success mt-3 w-100">
                        <i class="fa-solid fa-plus"></i>
                        Add
                    </button>
                </div>
            </div>
        </form>
        
        <hr class="mt-5">

        <h4 class="mt-5">List of books</h4>

        <form action="{{ route('book.index') }}" method="get"
              class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" 
                            name="title"
                            value="{{ request('title') }}"
                            class="form-control"
                            placeholder="Serch by title">
                </div>

                <div class="col-md-3">
                    <input type="text"
                            name="author"
                            value="{{ request('author') }}"
                            class="form-control"
                            placeholder="Search by author">
                </div>

                <div class="col-md-2">
                    <input type="text"
                           name="year_published"
                           value="{{ request('year_published') }}"
                           class="form-control"
                           placeholder="Year">
                </div>

                <div class="col-md-2">
                    <select name="sort" class="form-select">
                        <option value="">Sort by</option>
                        <option value="title_asc"
                         @selected(request('sort') === 'title_asc')>
                         Title: A ~ Z 
                        </option>
                        <option value="title_desc"
                        @selected(request('sort') === 'title_desc')>
                        Title: Z ~ A
                        </option>
                        <option value="year_desc"
                        @selected(request('sort') === 'year_desc')>
                            Year: Newest
                        </option>
                        <option value="year_asc"
                        @selected(request('sort') === 'year_asc')>
                            Year: Oldest
                        </option>
                        <option value="newest"
                        @selected(request('sort') === 'newest')>
                            Recently added
                        </option>
                        <option value="oldest"
                        @selected(request('sort') === 'oldest')>
                            Oldest added
                        </option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        Search
                    </button>
                </div>

                <div class="col-md-1">
                    <a href="{{ route('book.index') }}"
                       class="btn btn-outline-secondary w-100">
                            Clear
                    </a>
                </div>
            </div>  
        </form>

        <div class="border rounded overflow-hidden mt-2">
            <table class="table table-hover mb-0">
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>
                                <a href="{{ route('book.show', $book->id) }}">
                                    {{ $book->title }}
                                </a>
                            </td>
                            <td class="text-end">
                              <a href="{{ route('book.edit', $book->id) }}"
                                  class="btn btn-outline-warning me-4"
                                  type="submit">
                                    <i class="fa-solid fa-pen"></i>
                              </a>
                              <a href="{{ route('book.delete', $book->id) }}"
                                type="button" class="btn btn-outline-danger me-4">
                                <i class="fa-solid fa-trash-can"></i>
                              </a>
                              
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center pt-3">
                {{ $books->links('pagination::bootstrap-4')}}
            </div>
            
        </div>
        @if ($books->isEmpty())
            <p class="text-muted mt-3">No Books yet</p>
        @endif
    </div>

@endsection
