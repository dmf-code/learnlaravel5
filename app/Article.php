<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['title','body','user_id'];

    public function hasManyComments()
    {
        return $this->hasMany('App\Comment', 'article_id', 'id');
    }
}
