<?php

namespace Viviniko\Book\Repositories\Attr;

use Viviniko\Repository\CrudRepository;

interface AttrRepository extends CrudRepository
{
    /**
     * @return mixed
     */
    public function listWithAttributes();
}