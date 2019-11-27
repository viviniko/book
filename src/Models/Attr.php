<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;

class Attr extends Model
{
    protected $tableConfigKey = 'book.attrs_table';

    protected $fillable = [
        'name', 'is_filterable', 'is_searchable', 'is_viewable', 'sort'
    ];

    protected $casts = [
        'is_filterable' => 'boolean',
        'is_searchable' => 'boolean',
        'is_viewable' => 'boolean',
    ];

    public function values()
    {
        return $this->hasMany(Config::get('book.attr_value'), 'attr_id');
    }
}