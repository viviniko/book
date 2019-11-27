<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;

class AttrValue extends Model
{
    protected $tableConfigKey = 'book.attr_values_table';

    protected $fillable = ['attr_id', 'name', 'sort'];

    public function attr()
    {
        return $this->belongsTo(Config::get('book.attr'), 'attr_id');
    }
}