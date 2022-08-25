<?php

namespace Hanoivip\User\Services;

use Hanoivip\User\Device;
use Hanoivip\User\UserDevice;

class DeviceService
{   
    public function getUserDevices($userId)
    {
        return UserDevice::where('user_id', $userId)
        ->where('revoked', false)
        ->get();
    }
    
    public function getUserDevice($userId, $deviceId)
    {
        return UserDevice::where('user_id', $userId)
        ->where('device_id', $deviceId)
        ->where('revoked', false)
        ->first();
    }

    public function trustDevice($userId, $device)
    {
        $record = new UserDevice();
        $record->user_id = $userId;
        $record->device_id = $device->deviceId;
        $record->device_info = $device->info();
        $record->save();
        return true;
    }
    
    public function revokeUserDevice($userId, $deviceId)
    {
        return UserDevice::where('user_id', $userId)
        ->update(['revoked' => true]);
    }
    
    public function revokeAllDevices($userId)
    {
        UserDevice::where('user_id', $userId)
        ->update(['revoked', true]);
    }
    /**
     * 
     * @param number $userId
     * @param Device $device
     * @return boolean
     */
    public function needVerifyDevice($userId, $device)
    {
        return empty($this->getUserDevice($userId, $device->deviceId));
    }
    /**
     * 
     * @param Device $device
     * @param string $token
     */
    public function assignToken($device, $token)
    {
        UserDevice::where('device_id', $device->deviceId)
        ->where('revoked', false)
        ->update(['api_token' => $token]);
        return true;
    }
    /**
     * 
     * @param Device $device
     * @return string
     */
    public function getToken($device)
    {
        $record = UserDevice::where('device_id', $device->deviceId)
        ->where('revoked', false)
        ->first();
        return $record->api_token;
    }
    
    public function getDeviceByToken($token, $tokenColumn = 'api_token')
    {
        return UserDevice::where($tokenColumn, $token)->first();
    }
}