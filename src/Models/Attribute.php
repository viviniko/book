<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $tableConfigKey = 'book.attributes_table';

    protected $fillable = ['group_id', 'name', 'sort'];

    public function group()
    {
        return $this->belongsTo(Config::get('book.attribute_group'), 'group_id');
    }
}