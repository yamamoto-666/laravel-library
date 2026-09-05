@extends('layouts.app')

@section('title')

@section('content')

<div class="container">
    <form action="{{ route('author.update', $author->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="name" class="form-label fs-3">
            Edit Author
        </label>

        <input type="text" name="name" id="name"
            value="{{ old('name', $author->name) }}"
            class="form-control">

        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('author.index') }}"
                   class="btn btn-outline-secondary w-100 mt-3 fw-bold">
                    Cancel
                </a>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-outline-warning w-100 mt-3 fw-bold">
                    Update
                </button>
            </div>
        </div>
    </form>
</div>