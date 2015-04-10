<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dream extends Model {

    /**
     * Added attribute
     *
     * @var array
     */
    protected $appends = ['is_owner'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'user_id'];

    /**
     * The belongsTo relation.
     * 
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * is_owner mutator.
     * 
     */
    public function getIsOwnerAttribute()
    {
        if(auth()->check())
        {
            return $this->attributes['user_id'] === auth()->id() || auth()->user()->admin;
        }
        
        return false;
    }

}
