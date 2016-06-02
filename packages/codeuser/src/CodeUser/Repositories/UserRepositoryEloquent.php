<?php

namespace CodePress\CodeUser\Repositories;

use CodePress\CodeUser\Models\User;
use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeDatabase\Contracts\CriteriaCollection;

class UserRepositoryEloquent extends AbstractRepository implements UserRepositoryInterface, CriteriaCollection
{

    public function model()
    {
        return User::class;
    }

}
