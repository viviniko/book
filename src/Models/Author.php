<?php

namespace Viviniko\Book\Models;

use Viviniko\Support\Database\Eloquent\Model;

class Author extends Model
{
    protected $tableConfigKey = 'book.authors_table';

    protected $fillable = [
        'nickname', 'avatar',
    ];
}