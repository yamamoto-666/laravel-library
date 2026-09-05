<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\author;

class AuthorController extends Controller
{
    public $author;

    public function index(){
        $authors = Author::paginate(5);
        return view('author.index')->with('authors', $authors);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);

        $author = new Author();
        $author->name = $request->name;
        $author->save();

        return redirect()->back();
    }

    public function edit($id){
        $author = Author::findOrFail($id);
        return view('author.edit')->with('author', $author);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author       = Author::findOrFail($id);
        $author->name = $request->name;
        $author->save();

        return redirect()->route('author.index');

    }

    public function destroy($id){
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->back();
    }
}
