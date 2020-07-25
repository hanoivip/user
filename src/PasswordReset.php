<?php

namespace Hanoivip\User;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'email';
    protected $keyType = 'string';
}
