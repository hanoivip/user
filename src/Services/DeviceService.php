<?php

namespace Hanoivip\User\Services;

use Hanoivip\User\Device;
use Hanoivip\User\UserDevice;
use Exception;

class DeviceService
{   
    public function getUserDevices($userId)
    {
        return UserDevice::where('user_id', $userId)
        ->where('verified', true)
        ->where('revoked', false)
        ->get();
    }
    
    public function getUserDevice($userId, $deviceId)
    {
        return UserDevice::where('user_id', $userId)
        ->where('device_id', $deviceId)
        ->where('verified', true)
        ->where('revoked', false)
        ->first();
    }

    public function trustDevice($userId, $device)
    {
        UserDevice::where('user_id', $userId)
        ->where('device_id', $device->deviceId)
        ->where('verified', false)
        ->where('revoked', false)
        ->update(['verified' => true]);
        return true;
    }
    
    public function revokeUserDevice($userId, $deviceId)
    {
        return UserDevice::where('user_id', $userId)
        ->where('device_id', $deviceId)
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
    /**
     * 
     * @param Device $device
     */
    public function logDevice($device)
    {
        $record = UserDevice::where('device_id', $device->deviceId)->first();
        if (!empty($record))
            return;
        $record = new UserDevice();
        $record->user_id = 0;
        $record->device_id = $device->deviceId;
        $record->device_info = $device->info();
        $record->save();
    }
    
    public function mapUserDevice($userId, $device)
    {
        $record = UserDevice::where('device_id', $device->deviceId)->first();
        if (empty($record))
            return;
        if ($record->user_id != 0)
        {
            if ($record->user_id != $userId)
                throw new Exception("Device is other user??");
            return;
        }
        $record->user_id = $userId;
        $record->save();
    }
}