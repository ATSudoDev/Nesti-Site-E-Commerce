<?php

namespace App\Models;

use CodeIgniter\Model;

class TagHasRecipeModel extends Model
{
    protected $table = 'tags_has_recipes';
    protected $primaryKey = 'tags_id_tag';
    protected $allowedFields = ['tags_id_tag', 'recipes_id_recipes'];
    protected $returnType = 'App\Entities\TagHasRecipe';

}
