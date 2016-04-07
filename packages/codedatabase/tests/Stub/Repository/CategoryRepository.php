<?php

namespace CodePress\CodeDatabase\Repository;

use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeDatabase\Tests\Stub\Models\Category;

class CategoryRepository extends AbstractRepository
{

    public function model()
    {
        return Category::class;
    }

}
