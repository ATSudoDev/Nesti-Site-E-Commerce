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

    // SELECT recipes.id_recipe, recipes.name_recipe, ingredient_recipes.fk_id_product, ingredient_recipes.order_ingredient, ingredient_recipes.quantity_ingredient,  measure_units.name_measure_unit, products.name_product  FROM `recipes`
    // INNER JOIN ingredient_recipes ON recipes.id_recipe = ingredient_recipes.fk_id_recipe
    // INNER JOIN measure_units ON ingredient_recipes.fk_id_measure_unit = measure_units.id_measure_unit
    // INNER JOIN products ON products.id_product = ingredient_recipes.fk_id_product

    public function findStepsRecipeForApi($id_recipe)
    {
        $query = $this->db->query('SELECT * FROM `view_api_recipes_steps` WHERE id_recipe = "' . $id_recipe . '"');
        return $query->getResult();
    }

// SELECT recipes.id_recipe, recipes.name_recipe, paragraphs.order_paragraph, paragraphs.content_paragraph FROM `paragraphs`
// INNER JOIN recipes ON recipes.id_recipe = paragraphs.fk_id_recipes


}
