<?php

namespace CodePress\CodePost\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Validator;

class Comment extends Model
{

    use SoftDeletes;

    private $validator;
    protected $table = "code_comments";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'post_id',
        'content'
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
            'content' => 'required'
        ]);
        $validator->setData($this->attributes);

        if ($validator->fails()):
            $this->errors = $validator->errors();
            return false;
        endif;
        return true;
    }

    public function post()
    {
        return $this->belongsTo(Post::class)->withTrashed();
    }

}
