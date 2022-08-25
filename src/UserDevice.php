<?php

namespace Hanoivip\User;

use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
