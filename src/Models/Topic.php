<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Rewrite\RewriteTrait;
use Viviniko\Support\Database\Eloquent\Model;

class Topic extends Model
{
    use RewriteTrait;

    protected $tableConfigKey = 'book.topics_table';

    protected $fillable = [
        'parent_id', 'title', 'description', 'status', 'word_count', 'position', 'type', 'slug', 'published_at',
        'image_id', 'author_id',
    ];

//    protected $casts = [
//        'title' => 'json',
//        'description' => 'json',
//    ];

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function getLastChildAttribute()
    {
        return $this->children()->latest('position')->first();
    }

    public function content()
    {
        return $this->hasOne(Config::get('book.content'));
    }

    public function getDataAttribute()
    {
        return data_get($this->content, 'data');
    }
}