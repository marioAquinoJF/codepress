<?php

namespace CodePress\CodeCategory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Category extends Model implements SluggableInterface
{

    use SluggableTrait;

    private $validator;
    protected $table = "code_categories";
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

    public function categorizable()
    {
        return $this->morphTo();
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
