<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{
    public function findAllForApi(){
        $query =$this->db->query('SELECT * FROM `view_api_recipes`');
        return$query->getResult();
    }
}