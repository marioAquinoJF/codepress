<?php

namespace CodePress\CodeTag\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table = "code_tags";
    protected $fillable = [
        'name'
    ];

    public function taggable()
    {
        return $this->morphTo();
    }

}
