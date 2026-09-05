<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'images/';

    public function index(Request $request)
{
    $authors = Author::all();

    $sort = $request->input('sort');
    [$sortColumn, $sortDirection] = match($sort){
        'title_asc' => ['title', 'asc'],
        'title_desc' => ['title', 'desc'],
        'year_desc' => ['year_published', 'desc'],
        'year_asc' => ['year_published', 'asc'],
        'newest'  => ['created_at', 'desc'],
        'oldest' => ['created_at', 'asc'],
         default => ['created_at', 'desc'],
    };

    $books = Book::query()
        ->with('author')
        ->when($request->filled('title'), function ($query) use ($request) {
            $query->where(
                'title',
                'like',
                '%' . $request->title . '%'
            );
        })
        ->when($request->filled('author'), function ($query) use ($request) {
            $query->whereHas('author', function ($authorQuery) use ($request) {
                $authorQuery->where(
                    'name',
                    'like',
                    '%' . $request->author . '%'
                );
            });
        })
        ->when($request->filled('year_published'), function ($query) use ($request) {
            $query->where(
                'year_published',
                $request->year_published
            );
        })
        ->orderBy($sortColumn, $sortDirection)
        ->paginate(5)
        ->withQueryString();

    return view('book.index', compact('authors', 'books'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'year_published' => 'required|digits:4',
            'author_id' => 'nullable|exists:authors,id',
            'cover_photo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:6144',
        ]);

        $book = new Book;
        $book->title = $validated['title'];
        $book->year_published = $validated['year_published'];
        $book->author_id = $validated['author_id'] ?? null;

        if ($request->hasFile('cover_photo')) {
            $book->cover_photo = $this->savePhoto($request->file('cover_photo'));
        }

        $book->save();

        return redirect()->back()->with('success', 'Book added successfully.');
    }

    private function savePhoto($cover_photo)
    {

        $cover_photo_name = time().'.'.$cover_photo->extension();
        $cover_photo->storeAs(self::LOCAL_STORAGE_FOLDER, $cover_photo_name, 'public');

        return $cover_photo_name;
    }

    public function show($id){
        $book = book::findOrFail($id);
        return view('book.show', compact('book'));
    }

    public function edit($id){
        $book = Book::findOrFail($id);
        $authors = Author::all();
        return view('book.edit', compact('book', 'authors'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'author_id' => 'nullable|exists:authors,id',
            'year_published' => 'required|digits:4',
            'cover_photo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:6144',
        ]);

        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->year_published = $validated['year_published'];
        $book->author_id = $validated['author_id'] ?? null;

        $oldPhoto = $book->cover_photo;
        $photoChanged = $request->hasFile('cover_photo');

        if($photoChanged){
            $book->cover_photo = $this->savePhoto(
                $request->file('cover_photo'));
        }
        $book->save();

        if($photoChanged && $oldPhoto){
            $this->deleteImage($oldPhoto);
        }
        return redirect()->route('book.index');
    }



    private function deleteImage($cover_photo){
        $cover_photo_path = self::LOCAL_STORAGE_FOLDER . $cover_photo;

        if(Storage::disk('public')->exists($cover_photo_path)){
            Storage::disk('public')->delete($cover_photo_path);
        }
    }

    public function delete($id){
        $book = Book::findOrFail($id);

        return view('book.delete', compact('book'));
    }

    public function destroy($id){
        $book = Book::findOrFail($id);

        if($book->cover_photo){
            $this->deleteImage($book->cover_photo);
        }

        $book->delete();

        return redirect()->route('book.index');
    }
}
