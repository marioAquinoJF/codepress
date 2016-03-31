<?php

namespace CodePress\CodeTag\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;

class Tag extends Model
{

    private $validator;
    protected $table = "code_tags";
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

}
