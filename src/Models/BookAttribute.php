<?php

namespace Viviniko\Book\Models;

use Viviniko\Support\Database\Eloquent\Model;

class BookAttribute extends Model
{
    public $timestamps = false;

    protected $tableConfigKey = 'book.book_attribute_table';

    protected $fillable = [
        'book_id', 'attribute_id',
    ];
}