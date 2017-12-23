<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;
use Viviniko\Urlrewrite\UrlrewriteTrait;

class Category extends Model
{
    use UrlrewriteTrait;

    protected $tableConfigKey = 'book.categories_table';

    protected $fillable = [
        'name', 'description', 'is_active', 'parent_id', 'path', 'sort',
        'meta_title', 'meta_keywords', 'meta_description', 'url_rewrite',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(Config::get('book.category'), 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Config::get('book.category'), 'parent_id');
    }
}