<?php

namespace App\Models;

use CodeIgniter\Model;

class CommandLineModel extends Model
{
    protected $table = 'command_lines';
    protected $primaryKey = 'fk_id_command, fk_id_article' ;
    protected $allowedFields = [ 'command_quantity', 'fk_id_command', 'fk_id_article'];
    protected $returnType = 'App\Entities\CommandLine';

}