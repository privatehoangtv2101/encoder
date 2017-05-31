<?php

namespace Tests\Unit\Domains\Admin;

use Tests\TestCase;
use Domains\Admin\Entities\Admin;
use Domains\Admin\Repositories\AdminRepository;
use Domains\Admin\ValueObjects\AdminStatus;
use Domains\Admin\ValueObjects\AdminType;

/**
 * @author Tran Van Hoang <hoangtv2101@gmail.com>
 */
class LoginTest extends TestCase {

    private function createAdminRepositoryMock($dataStub) {
        $adminRepositoryMock = $this->createMock(AdminRepository::class);
        $adminRepositoryMock
                ->method('getAdminByEmail')
                ->will($this->returnCallback(function($email) use ($dataStub) {
                            if ($email !== $dataStub['email']) {
                                return null;
                            }
                            return $dataStub;
                        }));

        return $adminRepositoryMock;
    }

    /**
     * @test
     */
    public function login_with_wrong_account_name_so_user_will_not_be_able_to_login() {
        $adminRepositoryMock = $this->createAdminRepositoryMock(array(
            'name' => 'John Doe',
            'avatar' => 'http://example.com/dude-avatar.png',
            'email' => 'johndoe96@gmail.com',
            'password' => 'ee0ed4686b8d188e90ae6c726e9e0f88',
            'status' => AdminStatus::ACTIVE,
            'type' => AdminType::SUPER_ADMIN
        ));

        $admin = new Admin($adminRepositoryMock);
        $actual_result = $admin->login('not_exist@gmail.com', 'existpass');
        $this->assertFalse($actual_result);
    }

    /**
     * @test
     */
    public function login_with_wrong_password_so_user_will_not_be_able_to_login() {
        $adminRepositoryMock = $this->createAdminRepositoryMock(array(
            'name' => 'John Doe',
            'avatar' => 'http://example.com/dude-avatar.png',
            'email' => 'johndoe96@gmail.com',
            'password' => 'ee0ed4686b8d188e90ae6c726e9e0f88',
            'status' => AdminStatus::ACTIVE,
            'type' => AdminType::SUPER_ADMIN
        ));
        $admin = new Admin($adminRepositoryMock);
        $actual_result = $admin->login('johndoe96@gmail.com', 'not_exist_pass');
        $this->assertFalse($actual_result);
    }

    /**
     * @test
     */
    public function login_with_exist_account_but_it_were_disabled_so_user_will_not_be_able_to_login() {
        $adminRepositoryMock = $this->createAdminRepositoryMock(array(
            'name' => 'John Doe',
            'avatar' => 'http://example.com/dude-avatar.png',
            'email' => 'phatradang@gmail.com',
            'password' => 'ee0ed4686b8d188e90ae6c726e9e0f88',
            'status' => AdminStatus::DISABLE,
            'type' => AdminType::SUPER_ADMIN
        ));
        $admin = new Admin($adminRepositoryMock);
        $actual_result = $admin->login('phatradang@gmail.com', 'existpass');
        $this->assertFalse($actual_result);
    }

    /**
     * @test
     */
    public function login_with_exist_and_active_account_so_user_can_login_successfully() {
        $adminDataStub = array(
            'name' => 'John Doe',
            'avatar' => 'http://example.com/dude-avatar.png',
            'email' => 'johndoe96@gmail.com',
            'password' => 'ee0ed4686b8d188e90ae6c726e9e0f88',
            'status' => AdminStatus::ACTIVE,
            'type' => AdminType::SUPER_ADMIN
        );
        //TODO: create admin repository stub
        $adminRepositoryMock = $this->createAdminRepositoryMock($adminDataStub);
        //TODO: test
        $admin = new Admin($adminRepositoryMock);
        $actualResult = $admin->login('johndoe96@gmail.com', 'existpass');
        $this->assertEquals($adminDataStub, $actualResult);
    }

}
