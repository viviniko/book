<?php

namespace Viviniko\Book\Observers;

use Viviniko\Book\Contracts\BookService;
use Viviniko\Book\Enums\ChapterStatus;
use Viviniko\Book\Models\Chapter;
use Viviniko\Book\Repositories\Chapter\ChapterRepository;

class ChapterObserver
{
    protected $bookService;

    protected $chapters;

    public function __construct(BookService $bookService, ChapterRepository $chapters)
    {
        $this->bookService = $bookService;
        $this->chapters = $chapters;
    }

    public function saved(Chapter $chapter)
    {
        $path = $chapter->parent ? $chapter->parent->path : '';
        $path = trim($path . '/' . $chapter->id, '/');
        if ($chapter->path != $path) {
            $this->chapters->update($chapter->id, ['path' => $path]);
        }
        $this->bookService->updateBookState($chapter->book_id);
    }

    public function deleted(Chapter $chapter)
    {
        $this->bookService->updateBookState($chapter->book_id);
    }
}