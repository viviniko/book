<?php

namespace Viviniko\Book\Services;

use Viviniko\Book\Contracts\BookService;
use Viviniko\Book\Repositories\Book\BookRepository;
use Viviniko\Book\Repositories\Chapter\ChapterRepository;
use Viviniko\Book\Repositories\Content\ContentRepository;

class BookServiceImpl implements BookService
{
    protected $bookRepository;

    protected $chapterRepository;

    protected $contentRepository;

    public function __construct(
        BookRepository $bookRepository,
        ChapterRepository $chapterRepository,
        ContentRepository $contentRepository
    )
    {
        $this->bookRepository = $bookRepository;
        $this->chapterRepository = $chapterRepository;
        $this->contentRepository = $contentRepository;
    }
}