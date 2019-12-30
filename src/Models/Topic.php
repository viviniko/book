<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Book\LangTrait;
use Viviniko\Rewrite\RewriteTrait;
use Viviniko\Support\Database\Eloquent\Model;

class Topic extends Model
{
    use RewriteTrait, LangTrait;

    protected $tableConfigKey = 'book.topics_table';

    protected $fillable = [
        'parent_id', 'title', 'description', 'status', 'word_count', 'position', 'type', 'slug', 'published_at',
        'image_id', 'author_id',
    ];

    protected $langAttributes = [
        'title', 'description',
    ];

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
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