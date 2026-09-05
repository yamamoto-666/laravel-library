 @extends('layouts.app')
 
 @section('title')
 
 @section('content')
 
 <div class="container">
  <div class="card">
    <div class="card-header d-flex">
      <h3>Book Preview</h3>
      <span class="ms-auto me-4">
        <a href="{{ route('book.index') }}"
            class="btn btn-warning text-black">
          Back
        </a>
      </span>
      <span>
        <a href="{{ route('book.edit', $book->id) }}" type="button" 
           class="btn btn-warning text-black">
          Edit this book
        </a>
      </span>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-3">
          <img src="{{ asset('storage/images/'.$book->cover_photo )}}"
           alt="{{ $book->title }}"
           class="w-100"
           style="">
        </div>
        <div class="col-9 ">
         <h3>{{ $book->title }}</h3>
         <strong class="fs-3">by {{ $book->author?->name ?? 'No Author' }}</strong>
         <p class="fs-3">Published in {{ $book->year_published }}</p> 
        </div>
      </div>
    </div>
  </div>
 </div>
 
 @endsection