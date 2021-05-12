<?php

namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table = 'cities'; 
    protected $primaryKey = 'id_city';
    protected $allowedFields = ['id_city', 'name_city']; 
    protected $returnType = 'App\Entities\City'; 

}