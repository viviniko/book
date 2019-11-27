<?php

namespace Viviniko\Book\Observers;

use Viviniko\Book\Models\Attr;

class AttrObserver
{
    public function deleted(Attr $attr)
    {
        $attr->values->delete();
    }
}