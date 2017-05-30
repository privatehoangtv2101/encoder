<?php

namespace Tests\Unit\Domains\Admin;

use Tests\TestCase;
use Domains\Admin\Entities\Admin;
use Domains\Admin\Repositories\AdminRepository;
use Domains\Admin\ValueObjects\AdminStatus;

/**
 * @author Tran Van Hoang <hoangtv2101@gmail.com>
 */
class LoginTest extends TestCase {

    private function createAdminRepositoryStub($dataStub) {
        $adminRepositoryStub = $this->createMock(AdminRepository::class);
        $adminRepositoryStub
                ->method('login')
                ->will($this->returnCallback(function($email) use ($dataStub) {
                            if ($email !== $dataStub['email']) {
                                return null;
                            }
                            return $dataStub;
                        }));
        //->willReturn($dataStub);

        return $adminRepositoryStub;
    }

    /**
     * @test
     */
    public function login_with_wrong_account_name_so_user_will_not_be_able_to_login() {
        $adminRepositoryStub = $this->createAdminRepositoryStub(array(
            'name' => 'Trần Văn Hoàng',
            'avatar' => 'avatar.png',
            'email' => 'hoang@gmail.com',
            'password' => 'ee0ed4686b8d188e90ae6c726e9e0f88',
            'status' => AdminStatus::ACTIVE
        ));

        $admin = new Admin($adminRepositoryStub);
        $actual_result = $admin->login('not_exist@gmail.com', 'existpass');
        $this->assertFalse($actual_result);
    }

    /**
     * @test
     */
    public function login_with_wrong_password_so_user_will_not_be_able_to_login() {
        $adminRepositoryStub = $this->createAdminRepositoryStub(array(
            'name' => 'Trần Văn Hoàng',
            'avatar' => 'avatar.png',
            'email' => 'hoang@gmail.com',
            'password' => 'ee0ed4686b8d188e90ae6c726e9e0f88',
            'status' => AdminStatus::ACTIVE
        ));
        $admin = new Admin($adminRepositoryStub);
        $actual_result = $admin->login('hoang@gmail.com', 'not_exist_pass');
        $this->assertFalse($actual_result);
    }

    /**
     * @test
     */
    public function login_with_exist_account_but_it_were_disabled_so_user_will_not_be_able_to_login() {
        $adminRepositoryStub = $this->createAdminRepositoryStub(array(
            'name' => 'Trần Văn Hoàng',
            'avatar' => 'avatar.png',
            'email' => 'phatradang@gmail.com',
            'password' => 'ee0ed4686b8d188e90ae6c726e9e0f88',
            'status' => AdminStatus::DISABLE
        ));
        $admin = new Admin($adminRepositoryStub);
        $actual_result = $admin->login('phatradang@gmail.com', 'existpass');
        $this->assertFalse($actual_result);
    }

    /**
     * @test
     */
    public function login_with_exist_and_active_account_so_user_can_login_successfully() {
        //TODO: create admin repository stub
        $adminDataStub = array(
            'name' => 'Trần Văn Hoàng',
            'avatar' => 'avatar.png',
            'email' => 'hoang@gmail.com',
            'password' => 'ee0ed4686b8d188e90ae6c726e9e0f88',
            'status' => AdminStatus::ACTIVE
        );
        $adminRepositoryStub = $this->createMock(AdminRepository::class);
        $adminRepositoryStub->method('login')->willReturn($adminDataStub);

        //TODO: test
        $admin = new Admin($adminRepositoryStub);
        $actualResult = $admin->login('hoang@gmail.com', 'existpass');
        $this->assertEquals($adminDataStub, $actualResult);
    }

}
