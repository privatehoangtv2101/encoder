<?php

use Illuminate\Database\Seeder;
use Domains\Admin\ValueObjects\AdminStatus;
use Domains\Admin\ValueObjects\AdminType;
use Domains\Admin\Services\PasswordService;

class AdminTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('admin')->insert([
            'name' => 'Trần Văn Hoàng',
            'avatar' => 'avatar-hoang.png',
            'email' => 'hoang@gmail.com',
            'password' => PasswordService::hash('123123'),
            'status' => AdminStatus::ACTIVE,
            'type' => AdminType::SUPER_ADMIN
        ]);
        DB::table('admin')->insert([
            'name' => 'John Doe',
            'avatar' => 'avatar-johndoe.png',
            'email' => 'johndoe96@gmail.com',
            'password' => PasswordService::hash('doe1996'),
            'status' => AdminStatus::DISABLE,
            'type' => AdminType::MEMBER
        ]);
        DB::table('admin')->insert([
            'name' => 'FooBar',
            'avatar' => 'avatar-foobar.png',
            'email' => 'foobar96@gmail.com',
            'password' => PasswordService::hash('foobar'),
            'status' => AdminStatus::ACTIVE,
            'type' => AdminType::MEMBER
        ]);
        
       
    }

}
