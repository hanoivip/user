<?php

namespace Hanoivip\User;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ModAuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('not_current_email', function ($field, $value, $parameters) {
            //Log::debug('not_current_email check field:' . $field);
            if (Auth::check())
            {
                $email = Auth::user()->email;
                // Log::debug('not_current_email curent mail ' . $email . ' new mail ' . $value);
                return $email !== $value;
            }
            // Log::debug('not_current_email fail, not authenticated');
            return false;
        });
            
            Validator::extend('current_password', function ($field, $value, $parameters) {
                if (Auth::check())
                {
                    $uid = Auth::user()->id;
                    $user = User::find($uid);
                    if (Hash::check($value, $user->password))
                    {
                        //Log::debug('current_password success');
                        return true;
                    }
                }
                //Log::debug('current_password fail, not authenticated');
                return false;
            });
                
                Validator::extend('not_too_fast', function ($field, $value, $parameters) {
                    //Log::debug('not_too_fast check user not send validation too fast');
                    //Log::debug('parameters' . print_r($parameters, true));
                    if (Auth::check())
                    {
                        $uid = Auth::user()->id;
                        $user = User::find($uid);
                        $interval = config('id.email.toofast');
                        if (!empty($parameters))
                            $interval = intval($parameters[0]);
                            if (empty($user->last_email_validation))
                                return true;
                                $now = Carbon::now();
                                $lastEmail = new Carbon($user->last_email_validation);
                                $diff = $now->diffInSeconds($lastEmail);
                                Log::debug('diff in seconds' . $diff);
                                return $diff >= $interval;
                    }
                    return false;
                });
                    
                    Validator::extend('current_secure_pid', function ($field, $value, $parameters) {
                        if (Auth::check())
                        {
                            $uid = Auth::user()->id;
                            $secure = UserSecure::find($uid);
                            if (!empty($secure->personal_id) &&
                                $secure->personal_id != $value)
                            {
                                return false;
                            }
                            return true;
                        }
                        return false;
                    });
                        
                        Validator::extend('current_secure_phone', function ($field, $value, $parameters) {
                            if (Auth::check())
                            {
                                $uid = Auth::user()->id;
                                $secure = UserSecure::find($uid);
                                if (!empty($secure->phone) &&
                                    !empty($secure->phone_verified) &&
                                    $secure->phone_verified &&
                                    $secure->phone_verified != $value)
                                {
                                    return false;
                                }
                                return true;
                            }
                            return false;
                        });
                            
                            Validator::extend('current_secure_email', function ($field, $value, $parameters) {
                                if (Auth::check())
                                {
                                    $uid = Auth::user()->id;
                                    $secure = UserSecure::find($uid);
                                    if (!empty($secure->email) &&
                                        !empty($secure->email_verified) &&
                                        $secure->email != $value)
                                    {
                                        return false;
                                    }
                                    return true;
                                }
                                return false;
                            });
                                
                                Validator::extend('current_secure_pass2', function ($field, $value, $parameters) {
                                    if (Auth::check())
                                    {
                                        $uid = Auth::user()->id;
                                        $secure = UserSecure::find($uid);
                                        if (!empty($secure->pass2) &&
                                            !Hash::check($value, $secure->pass2))
                                        {
                                            return false;
                                        }
                                        return true;
                                    }
                                    return false;
                                });
                                    
                                    Validator::extend('current_secure_question', function ($field, $value, $parameters) {
                                        if (Auth::check())
                                        {
                                            $uid = Auth::user()->id;
                                            $secure = UserSecure::find($uid);
                                            if (!empty($secure->question) &&
                                                $secure->question != $value)
                                            {
                                                return false;
                                            }
                                            return true;
                                        }
                                        return false;
                                    });
                                        
                                        Validator::extend('current_secure_answer', function ($field, $value, $parameters) {
                                            if (Auth::check())
                                            {
                                                $uid = Auth::user()->id;
                                                $secure = UserSecure::find($uid);
                                                if (!empty($secure->answer) &&
                                                    !Hash::check($value, $secure->answer))
                                                {
                                                    return false;
                                                }
                                                return true;
                                            }
                                            return false;
                                        });
    }

    public function register()
    {
        
    }
}
