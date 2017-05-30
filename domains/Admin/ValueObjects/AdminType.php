<?php

namespace Domains\Admin\ValueObjects;

/**
 * @author Tran Van Hoang <hoangtv2101@gmail.com>
 */
class AdminType {

    const SUPER_ADMIN = 1;
    const MEMBER = 2;
    const DEFAULT_TYPE = self::MEMBER;

    public function isMember($adminType) {
        if (AdminType::MEMBER !== $adminType) {
            return false;
        }

        return true;
    }

    public function isSuperAdmin($adminType) {
        if (AdminType::SUPER_ADMIN !== $adminType) {
            return false;
        }

        return true;
    }

}
