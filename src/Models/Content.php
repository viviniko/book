<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;

class Content extends Model
{
    protected $tableConfigKey = 'book.contents_table';

    protected $primaryKey = 'topic_id';

    public $incrementing = false;

    protected $fillable = [
        'topic_id', 'data',
    ];

//    protected $casts = [
//        'data' => 'json',
//    ];

    public function topic()
    {
        return $this->belongsTo(Config::get('book.topic'));
    }
}