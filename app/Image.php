<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id', 'path', 'description'
    ];


    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function comment() 
    {
        return $this->hasMany(Comment::class);
    }
    
    public function like() 
    {
        return $this->hasMany(Like::class);
    }

    public function getGetPathAttribute()
    {
        if ( $this->path )
        {
            return url("storage/$this->path");
        }
    }
}
