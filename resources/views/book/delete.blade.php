@extends('layouts.app')

@section('title')

@section('content')

<div class="container">
  <div class="card">
    <div class="card-body">
      <h4>Delete book</h4>
      <p>Are you sure you want to delete 
         {{ $book->title }} by
         {{ $book->author?->name ?? 'No Author'}} ?
      </p>
      <form action="{{ route('book.destroy', $book->id) }}" method="post">
        @csrf
        @method('DELETE')
      <div class="row">
        <div class="col-6">
          <a href="{{ route('book.index') }}" class="btn btn-outline-secondary w-100">
            Cancel
          </a>
        </div>
        <div class="col-6">
          <button type="submit" class="btn btn-outline-danger bg-danger text-white w-100">
            Delete
          </button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
