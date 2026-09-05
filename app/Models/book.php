<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Http\Controllers\BookController;


class book extends Model
{
    protected $fillable = [
        'title',
        'year_published',
        'cover_photo',
        'author_id'  
    ];

    public function author(): BelongsTo{
        return $this->belongsTo(Author::class);
    }
}
