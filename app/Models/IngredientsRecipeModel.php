<?php

namespace App\Models;

use CodeIgniter\Model;

class IngredientsRecipeModel extends Model
{
    protected $table = 'ingredient_recipes'; 
    protected $primaryKey = 'fk_id_recipe';
    protected $allowedFields = ['quantity_ingredient', 'fk_id_measure_unit', 'fk_id_recipe', 'fk_id_product']; 
    protected $returnType = 'App\Entities\IngredientsRecipe'; 

}
