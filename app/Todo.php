<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['title','completed','user_id','description'];

    //change route key name
    // public function getRouteKeyName()
    // {
    //     return 'title';
    // } 

}
