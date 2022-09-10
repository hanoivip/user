<?php

namespace Hanoivip\User;

class Device
{   
    public $deviceId;
    
    public $deviceIp;
    
    public $deviceOs;
    
    public $deviceOsVer;
    
    public $deviceName;
    
    public $deviceVer;
    
    public function info()
    {
        $arr = ['os' => $this->deviceOs, 'osVer' => $this->deviceOsVer,
            'name' => $this->deviceName, 'ver' => $this->deviceVer,
            'ip' => $this->deviceIp
        ];
        return json_encode($arr);
    }
}
