<?php

namespace App\Models;

use CodeIgniter\Model;

class IngredientModel extends Model
{
    protected $table = 'ingredients';
    protected $primaryKey = 'fk_product_ingredient';
    protected $allowedFields = ['fk_product_ingredient'];
    protected $returnType = 'App\Entities\Ingredient'; 

}