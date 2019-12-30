<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Book\LangTrait;
use Viviniko\Support\Database\Eloquent\Model;

class Content extends Model
{
    use LangTrait;

    protected $tableConfigKey = 'book.contents_table';

    protected $primaryKey = 'topic_id';

    public $incrementing = false;

    protected $fillable = [
        'topic_id', 'data',
    ];

    protected $langAttributes = [
        'data',
    ];

    public function topic()
    {
        return $this->belongsTo(Config::get('book.topic'));
    }
}