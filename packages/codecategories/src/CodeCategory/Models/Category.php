<?php

namespace CodePress\CodeCategory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use CodePress\CodePost\Models\Post;

class Category extends Model implements SluggableInterface
{

    use SluggableTrait,
        SoftDeletes;

    private $validator;
    protected $table = "code_categories";
    protected $dates = ['deleted_at'];
    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
        'unique' => true
    ];
    protected $fillable = [
        'name',
        'active',
        'parent_id',
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
        $this->validator
                ->setRules(['name' => 'required|255']);
        $this->validator
                ->setData($this->attributes);
        if ($this->validator->fails()):
            $this->errors = $this->validator->errors();
            return false;
        endif;
        return true;
    }

    public function posts()
    {
        return $this->morphedByMany('CodePress\CodePost\Models\Post', 'categorizable', 'code_categorizables');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

}
