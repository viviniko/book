<?php

namespace Viviniko\Book\Repositories\Book;

use Illuminate\Support\Facades\DB;
use Viviniko\Repository\SimpleRepository;

class EloquentBook extends SimpleRepository implements BookRepository
{
    protected $modelConfigKey = 'book.book';

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $book = null;

        DB::transaction(function () use ($data, &$book) {
            $book = parent::create($data);

            if (!empty($data['attributes'])) {
                $book->attributes()->sync($data['attributes']);
            }
        });

        return $book;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $book = null;

        DB::transaction(function () use ($id, $data, &$product) {
            $book = parent::update($id, $data);

            if (!empty($data['attributes'])) {
                $book->attributes()->sync($data['attributes']);
            }
        });

        return $book;
    }
}