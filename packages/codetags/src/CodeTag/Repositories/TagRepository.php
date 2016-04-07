<?php

namespace CodePress\CodeTag\Repositories;

use CodePress\CodeTag\Models\Tag;
use CodePress\CodeDatabase\AbstractRepository;

class TagRepository extends AbstractRepository
{

    public function model()
    {
        return Tag::class;
    }

}
