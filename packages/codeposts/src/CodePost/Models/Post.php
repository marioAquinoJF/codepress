<?php

namespace CodePress\CodePost\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Post extends Model implements SluggableInterface
{

    use SluggableTrait;

    private $validator;
    protected $table = "code_posts";
    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug',
        'unique' => true
    ];
    protected $fillable = [
        'title',
        'content',
        'slug'
    ];

    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function isValid()
    {
        $validator = $this->validator;
        $validator->setRules([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);
        $validator->setData($this->attributes);

        if ($validator->fails()):
            $this->errors = $validator->errors();
            return false;
        endif;
        return true;
    }

    public function categories()
    {
        return $this->morphToMany('\CodePress\CodeCategory\Models\Category', 'categorizable', 'code_categorizables');
    }

    public function tags()
    {
        return $this->morphToMany('\CodePress\CodeTag\Models\Tag', 'taggable', 'code_taggables');
    }

}
