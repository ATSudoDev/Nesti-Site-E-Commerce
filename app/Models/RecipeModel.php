<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{

    protected $table = 'recipes';
    protected $primaryKey = 'id_recipe';
    protected $allowedFields = ['id_recipe', 'name_recipe', 'difficulty_recipe', 'numberperson_recipe', 'state_recipe', 'time_recipe', 'fk_id_image', 'fk_id_chief']; 
    protected $returnType = 'App\Entities\Recipe';
 

    public function findAllForApi()
    {
        $query = $this->db->query('SELECT * FROM `view_api_recipes`');
        return $query->getResult();
    }

    public function findCatForApi($cat)
    {
        $query = $this->db->query('SELECT * FROM `view_api_recipes` WHERE cat = "' . $cat . '"');
        return $query->getResult();
    }

    public function findIngredientRecipeForApi($id_recipe)
    {
        $query = $this->db->query('SELECT * FROM `view_api_recipes_ingredients` WHERE id_recipe = "' . $id_recipe . '"');
        return $query->getResult();
    }

    public function findStepsRecipeForApi($id_recipe)
    {
        $query = $this->db->query('SELECT * FROM `view_api_recipes_steps` WHERE id_recipe = "' . $id_recipe . '"');
        return $query->getResult();
    }

    public function searchRecipe(String $name){
        $builder = $this->db->table('recipes');
        $builder->like("name_recipe", "%".$name."%");
        $query = $builder->get();
        return $query->getResult();
    }

}
