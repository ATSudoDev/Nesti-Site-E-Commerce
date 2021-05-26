<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username_user', 'password_user', 'lastname_user', 'firstname_user', 'email_user', 'state_user', 'date_creation_user', 'address1_user', 'adresse2_user', 'postcode_user', 'fk_id_city'];
    protected $returnType = 'App\Entities\User';
    
    public function checkUser($username)
    {
        $builder = $this->db->table('users');
        $builder->where("username_user", $username);
        $query = $builder->get();

        return $query->getResult();
    }
}
