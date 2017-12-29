<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;

class Author extends Model
{
    protected $tableConfigKey = 'book.authors_table';

    protected $fillable = [
        'nickname', 'avatar',
    ];

    public function books()
    {
        return $this->hasMany(Config::get('book.book'), 'author_id');
    }
}