<?php

namespace Domains\Admin\Services;

use Hash;

/**
 * @author Tran Van Hoang <hoangtv2101@gmail.com>
 */
class PasswordService {

    public static function hash($plainText) {
        return bcrypt($plainText);
    }

    public static function isCorrectPassword($inputPassword, $hashPassword) {
        if (!Hash::check($inputPassword, $hashPassword)){
            return false;
        }

        return true;
    }

}
