<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;
use Viviniko\Rewrite\RewriteTrait;

class Category extends Model
{
    use RewriteTrait;

    protected $tableConfigKey = 'book.categories_table';

    protected $fillable = [
        'name', 'description', 'status', 'parent_id', 'path', 'position', 'slug',
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