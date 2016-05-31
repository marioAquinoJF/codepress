<?php

namespace CodePress\CodePost\Repositories;

use CodePress\CodePost\Models\Comment;
use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeDatabase\Contracts\CriteriaCollection;

class CommentRepositoryEloquent extends AbstractRepository implements CommentRepositoryInterface, CriteriaCollection
{

    public function model()
    {
        return Comment::class;
    }

}
