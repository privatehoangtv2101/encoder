<?php

namespace Domains\Admin\Repositories;

use Domains\Admin\Repositories\AdminRepository;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class AdminRepositoryEloquent extends Authenticatable implements AdminRepository {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','password','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];

    public function findByID($id) {
        
    }

    public function getAdminByEmail($email) {
        $data = AdminRepositoryEloquent::where('email', '=', $email)
                        ->first();
        if(!$data){
            return false;
        }
        
        return $data->toArray();
    }

    public function storeLoginData($user) {
        Auth::loginUsingId($user['id']);
    }

}
