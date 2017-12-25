<?php

namespace Viviniko\Book\Contracts;

interface BookService
{
    public function updateBookState($bookId);
}