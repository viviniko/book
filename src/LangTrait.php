<?php

namespace Viviniko\Book;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

trait LangTrait
{
    private $lang;

    protected $langAttributes = [];

    public function initializeLangTrait()
    {
        $this->lang = Config::get('app.locale');
        foreach ($this->langAttributes as $attribute) {
            if (!isset($this->casts[$attribute])) {
                $this->casts[$attribute] = 'json';
                $this->registerGetter($attribute);
                $this->registerSetter($attribute);
            }
        }
    }

    private function registerSetter($attribute)
    {
        $method = 'set'.Str::studly($attribute).'Attribute';
        $this->$method = function ($value) use ($attribute) {
            $this->attributes[$attribute] = array_merge($this->attributes ?? [], [$this->lang => $value]);
        };
    }

    private function registerGetter($attribute)
    {
        $method = 'get'.Str::studly($attribute).'Attribute';
        $this->$method = function ($value) {
            return $value[$this->lang] ?: null;
        };
    }

}