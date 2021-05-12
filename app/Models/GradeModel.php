<?php

namespace App\Models;

use CodeIgniter\Model;

class GradeModel extends Model
{
    protected $table = 'give_grades';
    protected $primaryKey = 'fk_id_recipe , fk_id_user';
    protected $allowedFields = ['grade_out_of_5', 'fk_id_recipe', 'fk_id_user'];
    protected $returnType = 'App\Entities\Grade'; 

}