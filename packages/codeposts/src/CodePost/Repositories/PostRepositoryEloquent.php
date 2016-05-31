<?php

namespace CodePress\CodePost\Repositories;

use CodePress\CodePost\Models\Post;
use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeDatabase\Contracts\CriteriaCollection;

class PostRepositoryEloquent extends AbstractRepository implements PostRepositoryInterface, CriteriaCollection
{

    public function model()
    {
        return Post::class;
    }

}
