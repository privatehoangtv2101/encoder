<?php

namespace Domains\Admin\Services;

/**
 * @author Tran Van Hoang <hoangtv2101@gmail.com>
 */
class PasswordService {

    public static function hash($plainText) {
        return md5(sha1($plainText) . '5uj');
    }
    
    public static function isCorrectPassword($inputPassword,$hashPassword){
        if(self::hash($inputPassword) !== $hashPassword){
            return false;
        }
        
        return true;
    }

}
