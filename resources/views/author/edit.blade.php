@extends('layouts.app')

@section('title', 'Edit Author')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4">Edit Author</h3>

                    <form action="{{ route('author.update', $author->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <label for="name" class="form-label">Author name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $author->name) }}"
                            class="form-control @error('name') is-invalid @enderror"
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="row g-3 mt-2">
                            <div class="col-6">
                                <a href="{{ route('author.index') }}"
                                   class="btn btn-outline-secondary w-100 fw-bold">
                                    Cancel
                                </a>
                            </div>

                            <div class="col-6">
                                <button type="submit" class="btn btn-warning w-100 fw-bold">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
