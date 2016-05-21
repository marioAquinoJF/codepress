<?php

namespace CodePress\CodeCategory\Repositories;

use CodePress\CodeCategory\Models\Category;
use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeDatabase\Contracts\CriteriaCollection;

class CategoryRepositoryEloquent extends AbstractRepository implements CategoryRepositoryInterface, CriteriaCollection
{

    public function model()
    {
        return Category::class;
    }

}
