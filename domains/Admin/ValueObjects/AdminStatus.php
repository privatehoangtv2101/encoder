<?php

namespace Domains\Admin\ValueObjects;

/**
 * @author Tran Van Hoang <hoangtv2101@gmail.com>
 */
class AdminStatus {

    const ACTIVE = 1;
    const DISABLE = 2;
    const DEFAULT_STATUS = self::ACTIVE;
    
    public static function isActive($status){
        if(self::ACTIVE !== $status){
            return false;
        }
        
        return true;
    }

}
