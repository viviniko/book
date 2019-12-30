<?php

namespace Viviniko\Book;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

trait LangTrait
{
    private static $lang;

    protected $langAttributes = [];

    public function initializeLangTrait()
    {
        foreach ($this->langAttributes as $attribute) {
            if (!isset($this->casts[$attribute])) {
                $this->casts[$attribute] = 'json';
                $this->registerGetter($attribute);
                $this->registerSetter($attribute);
            }
        }
    }

    public static function lang($lang = null)
    {
        if ($lang) {
            self::$lang = $lang;
        }

        return self::$lang ?? Config::get('app.locale');
    }

    private function registerSetter($attribute)
    {
        $method = 'set'.Str::studly($attribute).'Attribute';
        $this->$method = function ($value) use ($attribute) {
            $this->attributes[$attribute] = array_merge($this->attributes ?? [], [self::lang() => $value]);
        };
    }

    private function registerGetter($attribute)
    {
        $method = 'get'.Str::studly($attribute).'Attribute';
        $this->$method = function ($value) {
            return $value[self::lang()] ?: null;
        };
    }

}