@extends('layouts.app')

@section('title')

@section('content')
   <div class="container">
    <div class="row">

        
        <div class="col-md-6">
            <div class="border rounded p-3">
                <a href="{{ route('author.index')}}"  style="text-decoration-line: none;" class="btn ">
                    <h3 class="text-primary">Authors</h3>
                </a>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="border rounded p-3">
                <a href="{{ route('book.index') }}" style="text-decoration-line: none;" class="btn">
                    <h3 class="text-success">Books</h3>
                </a>
            </div>
        </div>

    </div>
    
</div>



@endsection
