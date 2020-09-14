<?php

namespace Hanoivip\User\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    const USER_INFO_CACHE = 'USER_INFO_CACHE';
    
    private $credentialService;
    
    public function __construct(CredentialService $service)
    {
        $this->credentialService = $service;
    }
    
    /**
     * 
     * @param number $uid
     */
    public function getUserInfo($uid)
    {
        $key = self::USER_INFO_CACHE . $uid;
        if (Cache::has($key))
        {
            return Cache::get($key);
        }
        $userInfo = $this->credentialService->getUserCredentials($uid);
        if (!empty($userInfo))
        {
            Cache::put($key, $userInfo, 86400);
        }
    }
    
}