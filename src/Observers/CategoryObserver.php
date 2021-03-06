<?php

namespace Viviniko\Book\Observers;

use Viviniko\Book\Models\Category;
use Viviniko\Book\Repositories\Category\CategoryRepository;

class CategoryObserver
{
    protected $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function saved(Category $category)
    {
        $path = $category->parent ? $category->parent->path : '';
        $path = trim($path . '/' . $category->id, '/');
        if ($category->path != $path) {
            $this->categories->update($category->id, ['path' => $path]);
        }
    }
}