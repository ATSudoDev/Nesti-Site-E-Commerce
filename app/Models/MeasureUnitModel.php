<?php

namespace App\Models;

use CodeIgniter\Model;

class MeasureUnitModel extends Model
{
    protected $table = 'measure_units'; 
    protected $primaryKey = 'id_measure_unit';
    protected $allowedFields = ['id_measure_unit', 'name_measure_unit']; 
    protected $returnType = 'App\Entities\MeasureUnit'; 

    
}
