<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $tableConfigKey = 'book.attribute_groups_table';

    protected $fillable = [
        'name', 'is_filterable', 'is_searchable', 'is_viewable', 'sort'
    ];

    protected $casts = [
        'is_filterable' => 'boolean',
        'is_required' => 'boolean',
        'is_viewable' => 'boolean',
    ];

    public function attributes()
    {
        return $this->hasMany(Config::get('book.attribute'), 'group_id');
    }
}