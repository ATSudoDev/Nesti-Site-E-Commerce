<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenLogModel extends Model
{
    protected $table = 'logs_token';
    protected $primaryKey = 'id_log_token';
    protected $allowedFields = ['id_log_token', 'date_use_token', 'fk_id_token', 'from_where'];
    protected $returnType = 'App\Entities\LogToken';

}
