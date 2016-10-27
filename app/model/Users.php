<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    /**
     * Get the interaction record associated with the user.
     */
    public function interactions()
    {
        return $this->hasMany('App\model\Interactions', 'user_id', 'id');
    }
}
