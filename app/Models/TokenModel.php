<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model
{
    protected $table = 'token';
    protected $primaryKey = 'id_token';
    protected $allowedFields = ['id_token', 'value_token', 'from_where'];
    protected $returnType = 'App\Entities\Token';

}
