<?php

namespace App\Repository;

use App\Models\user;

interface userRepo
{
    public function insert(user $user): user;
    public function insertAdmin(user $user): user;
    public function update(user $user): user;
}
