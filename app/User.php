<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $guarded = [];
    protected $fillable = [
        'name', 'email', 'password','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //auto bcrypt password
    //mutate
    // public function setPasswordAttribute($password){
    //     $this->attributes['password'] = bcrypt($password);
    // }

    // //accesser
    // public function getNameAttribute($name)
    // {
    //     return 'My name is : ' .ucfirst($name);
    // }
    public static function uploadAvatar($image)
    {
        $filename = $image->getClientOriginalName();
        (new self())->deleteOldImage();
        //$request->image->store('images','public');
        //User::find(1)->update(['avatar'=>$filename]);

        $image->storeAs('images',$filename,'public');
        auth()->user()->update(['avatar'=>$filename]);
    }

    private function deleteOldImage()
    {
        if ($this->avatar)
        {
            Storage::delete('/public/images/'.auth()->user()->avatar);
        }
    
    }


    // public function todos() //public function store(TodoCreateRequest $request) //todo controleer.php
    // {
    //     return $this->hasMany(Todo::class);
    // }

    public function  todos() // relation ship
    {
        //return $this->hasManay('App\Todo');

        //return $this->hasManay(Todo::class,"creator_id"); //todos not same as user id

        return $this->hasMany(Todo::class);
    }
  
}
