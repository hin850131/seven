<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Step;
class Todo extends Model
{
    protected $fillable = ['title','completed','user_id','description'];

    //relationship
    public function steps()
    {
        return $this->hasMany(Step::class);
    }
    //change route key name
    // public function getRouteKeyName()
    // {
    //     return 'title';
    // } 

}
