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
        $query = $this->db->query('SELECT tags.tag_name, recipes.id_recipe, recipes.name_recipe, recipes.time_recipe, recipes.difficulty_recipe, users.username_user, recipes.number_person_recipe, CONCAT(images.name_image, "." , images.extension_image) as img FROM tags 
        INNER JOIN tags_has_recipes ON tags_has_recipes.tags_id_tag = tags.id_tag 
        INNER JOIN recipes ON recipes.id_recipe = tags_has_recipes.recipes_id_recipes
        INNER JOIN chiefs ON recipes.fk_id_chief = chiefs.fk_id_user
        INNER JOIN users ON chiefs.fk_id_user = users.id_user
        INNER JOIN images ON recipes.fk_id_image = images.id_image');
        return $query->getResult();
    }

    public function findCatForApi($cat)
    {
        $query = $this->db->query('SELECT tags.tag_name, recipes.id_recipe, recipes.name_recipe, recipes.time_recipe, recipes.difficulty_recipe, users.username_user, recipes.number_person_recipe, CONCAT(images.name_image, "." , images.extension_image) as img FROM tags 
        INNER JOIN tags_has_recipes ON tags_has_recipes.tags_id_tag = tags.id_tag 
        INNER JOIN recipes ON recipes.id_recipe = tags_has_recipes.recipes_id_recipes
        INNER JOIN chiefs ON recipes.fk_id_chief = chiefs.fk_id_user
        INNER JOIN users ON chiefs.fk_id_user = users.id_user
        INNER JOIN images ON recipes.fk_id_image = images.id_image 
        WHERE tag_name = "' . $cat . '"');
        return $query->getResult();
    }

    // SELECT tags.tag_name as cat, recipes.id_recipe, recipes.name_recipe, recipes.time_recipe, recipes.difficulty_recipe FROM `tags` 
    // INNER JOIN tags_has_recipes ON tags_has_recipes.tags_id_tag = tags.id_tag 
    // INNER JOIN recipes ON recipes.id_recipe = tags_has_recipes.recipes_id_recipes 

    public function findIngredientRecipeForApi($id_recipe)
    {
        $query = $this->db->query('SELECT quantity_ingredient, name_product, fk_id_product, name_measure_unit FROM recipes 
        INNER JOIN ingredient_recipes ON ingredient_recipes.fk_id_recipe = recipes.id_recipe
        INNER JOIN measure_units ON measure_units.id_measure_unit = ingredient_recipes.fk_id_measure_unit
        INNER JOIN products ON ingredient_recipes.fk_id_product = products.id_product
        WHERE recipes.id_recipe = "' . $id_recipe . '"');
        return $query->getResult();
    }

        // SELECT name_product FROM recipes 
        // INNER JOIN ingredient_recipes ON ingredient_recipes.fk_id_recipe = recipes.id_recipe
        // INNER JOIN products ON ingredient_recipes.fk_id_product = products.id_product
        // WHERE recipes.id_recipe = 1

    public function findStepsRecipeForApi($id_recipe)
    {
        $query = $this->db->query('SELECT content_paragraph FROM recipes
        INNER JOIN paragraphs ON paragraphs.fk_id_recipes = recipes.id_recipe
        WHERE recipes.id_recipe = "' . $id_recipe . '"');
        return $query->getResult();
    }

    // SELECT * FROM recipes
    // INNER JOIN paragraphs ON paragraphs.fk_id_recipes = recipes.id_recipe
    // WHERE recipes.id_recipe = 1

    public function findSearchRecipeForApi($keyword) {
        $query = $this->db->query('SELECT id_recipe, name_recipe, time_recipe, number_person_recipe FROM recipes WHERE name_recipe LIKE "%' . $keyword . '%" ');
        return $query->getResult();
    }

    public function searchRecipe(String $name){
        $builder = $this->db->table('recipes');
        $builder->like("name_recipe", "%".$name."%");
        $query = $builder->get();
        return $query->getResult();
    }

}
