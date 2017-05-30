<?php

namespace Domains\Admin\Entities;

use Domains\Admin\Repositories\AdminRepository;
use Domains\Admin\ValueObjects\AdminStatus;
use Domains\Admin\Services\PasswordService;

class Admin {

    /**
     * @var \Domains\Admin\Repositories\AdminRepository  
     */
    private $adminRepository;

    public function __construct(AdminRepository $adminRepository) {
        $this->adminRepository = $adminRepository;
    }

    public function login($email, $password) {
        $loginData = $this->adminRepository->login($email);
        if(!$loginData){
            return false;
        }
        
        $isCorrectPassword = PasswordService::isCorrectPassword($password,$loginData['password']);
        if(!$isCorrectPassword){
            return false;
        }
        
        $isActive = AdminStatus::isActive($loginData['status']);
        if (!$isActive) {
            return false;
        }
        
        return $loginData;
    }

}
