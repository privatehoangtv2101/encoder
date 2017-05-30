<?php

namespace Domains\Admin\Repositories;

interface AdminRepository {

    public function findByID($id);
    
    public function login($email);
}
