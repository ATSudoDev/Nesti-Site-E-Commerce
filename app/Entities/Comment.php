<?php

namespace App\Entities;

use CodeIgniter\Entity;

//MODELS
use App\Models\UserModel;

class Comment extends Entity
{

    public function getUser()
    {
        $userModel = new UserModel();
        $user = $userModel->find($this->fk_id_user);
        return $user;
    }
}
