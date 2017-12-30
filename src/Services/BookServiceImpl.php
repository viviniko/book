<?php

namespace Viviniko\Book\Services;

use Viviniko\Book\Contracts\BookService;
use Viviniko\Book\Repositories\Author\AuthorRepository;
use Viviniko\Book\Repositories\Book\BookRepository;
use Viviniko\Book\Repositories\Chapter\ChapterRepository;
use Viviniko\Book\Repositories\Content\ContentRepository;

class BookServiceImpl implements BookService
{
    protected $bookRepository;

    protected $authorRepository;

    protected $chapterRepository;

    protected $contentRepository;

    public function __construct(
        BookRepository $bookRepository,
        ChapterRepository $chapterRepository,
        ContentRepository $contentRepository,
        AuthorRepository $authorRepository
    )
    {
        $this->bookRepository = $bookRepository;
        $this->chapterRepository = $chapterRepository;
        $this->contentRepository = $contentRepository;
        $this->authorRepository = $authorRepository;
    }

    public function updateBookState($bookId)
    {
        $data = [];
        $book = $this->bookRepository->find($bookId);
        $wordCount = $this->chapterRepository->countWordsByBookId($bookId);
        if ($wordCount != $book->word_count) {
            $data['word_count'] = $wordCount;
        }
        $latestChapter = $this->chapterRepository->getLatestChapterByBookId($bookId);
        if ($latestChapter->id != $book->latest_chapter_id) {
            $data['latest_chapter_id'] = $latestChapter->id;
        }
        $maxNumber = $this->chapterRepository->getMaxNumberByBookId($bookId);
        if ($maxNumber != $book->chapter_max_number) {
            $data['chapter_max_number'] = $maxNumber;
        }

        if (!empty($data))
            $this->bookRepository->update($bookId, $data);
    }

    public function buildBookChaptersNumber($bookId)
    {
        $number = 1;
        $this->updateGroupChaptersNumber($this->chapterRepository->getChaptersTreeByBookId($bookId), $number);
    }

    protected function updateGroupChaptersNumber($chapters, &$number)
    {
        foreach ($chapters as $chapter) {
            if ($chapter->number != $number) {
                $this->chapterRepository->update($chapter->id, ['number' => $number]);
            }
            ++$number;
            if ($chapter->children && count($chapter->children) > 0) {
                $this->updateGroupChaptersNumber($chapter->children, $number);
            }
        }
    }

}