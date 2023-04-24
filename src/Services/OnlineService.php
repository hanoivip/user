<?php

namespace Hanoivip\User\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Hanoivip\User\User;
use Hanoivip\User\UserDevice;

class OnlineService
{
    public function getOnlineNow()
    {
        
    }
    /**
     * 
     * @param number $periods Default 30 dayds = 43200 minutes
     */
    public function getCurrentLogins($periods = 43200)
    {
        $lastDay = Carbon::now()->subMinutes($periods);
        $devices = UserDevice::whereDate("updated_at", ">=", $lastDay->format("Y-m-d"))->get();
        $ids = [];
        if ($devices->isNotEmpty())
        {
            foreach ($devices as $device)
            {
                $ids[$device->user_id] = 1;
            }
            Log::debug("Player num " . count(array_keys($ids)));
            if (!empty($ids))
            {
                return User::whereIn('id', array_keys($ids))->get();
            }
        }
    }
}