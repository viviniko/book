<?php

namespace Viviniko\Book\Observers;

use Viviniko\Book\Contracts\BookService;
use Viviniko\Book\Enums\ChapterStatus;
use Viviniko\Book\Models\Chapter;

class ChapterObserver
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function saved(Chapter $chapter)
    {
        $this->bookService->updateBookState($chapter->book_id);
    }

    public function deleted(Chapter $chapter)
    {
        $this->bookService->updateBookState($chapter->book_id);
    }
}