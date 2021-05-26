<?php

namespace App\Models;

use CodeIgniter\Model;

class UserLogModel extends Model
{
    protected $table = 'logs_users';
    protected $primaryKey = 'id_log_user';
    protected $allowedFields = ['id_log_user', 'date_connection_log_user', 'fk_id_user'];
    protected $returnType = 'App\Entities\LogUser';
    
}
