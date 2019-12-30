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

    public function topics()
    {
        return $this->hasMany(Config::get('book.topic'), 'author_id');
    }
}