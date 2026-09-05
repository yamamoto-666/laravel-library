@extends('layouts.app')

@section('title')

@section('content')

    <div class="container">
        <form action="{{ route('author.store') }}" method="post">
          @csrf
          @method('POST')
          <label for="name" class="label-control fs-3">Authors</label>
            <div class="d-flex gap-2">
                <input type="text" name="name" id="name" class="form-control" placeholder="add new author">
                <button type="submit" class="btn btn-outline-success">
                    <i class="fa-solid fa-circle-plus"></i>
                    Add
                </button>
            </div>
        </form>
        @if ($authors->isEmpty())
        <p class="text-muted mt-3">No Authors yet</p>
        @endif
        
        <div class="container">
          <table class="table table-hover align-middle mt-5">
            
              @foreach ($authors as $author)
              <tr>
                  <td>
                    {{ $author->name }}
                  </td>
                  <td class="text-end">
                    <a href="{{ route('author.edit', $author->id) }}">
                      <i class="fa-solid fa-pen text-warning"></i>
                    </a>
                    <button type="button" 
                      class="btn"
                      data-bs-toggle="modal"
                      data-bs-target="#delete-product-{{ $author->id }}">
                      <i class="fa-solid fa-trash-can text-danger"></i>
                      
                    </button>
                  </td>
              </tr>
              @include('author.delete')
              @endforeach
              
          </table>
          <div class="d-flex justify-content-center pt-3">
                {{ $authors->links('pagination::bootstrap-4')}}
            </div>
    </div>

@endsection
