<?php

namespace CodePress\CodeTag\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{

    use SoftDeletes;

    private $validator;
    protected $table = "code_tags";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name'
    ];

    public function taggable()
    {
        return $this->morphTo();
    }

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
        return $this->morphedByMany('CodePress\CodePost\Models\Post', 'taggable', 'code_taggables');
    }

}
