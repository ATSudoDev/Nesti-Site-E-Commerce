<?php

namespace App\Models;

use CodeIgniter\Model;

class CommandModel extends Model
{
    protected $table = 'commands'; 
    protected $primaryKey = 'id_command';
    protected $allowedFields = ['id_command', 'state_command', 'date_creation_command', 'fk_id_user']; 
    protected $returnType = 'App\Entities\Command'; 

}