<?php

namespace Viviniko\Book\Contracts;

interface BookService
{
    public function updateBookState($bookId);

    public function buildBookChaptersNumber($bookId);

    public function getBook($bookId);
}