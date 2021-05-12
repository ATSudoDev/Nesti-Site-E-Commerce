<?php

namespace App\Controllers;

use App\Models\RecipeModel;
use App\Models\TagModel;
use App\Models\TagHasRecipeModel;

class TagsController extends BaseController
{

  public function tag($idTag)
  {
      helper('form');
      $recipeModel = new RecipeModel();
      $tagModel = new TagModel();
      $tagHasRecipeModel = new TagHasRecipeModel();
      
      $tags = $tagModel->findAll();

      $tagHasRecipes = $tagHasRecipeModel->where("tags_id_tag", $idTag)->findAll();
     
      $recipes = [];
      foreach( $tagHasRecipes as $tagHasRecipe){
        $recipes[] =  $recipeModel->find($tagHasRecipe->recipes_id_recipes);
      }

      $data["loc"] = "recipes";
      $data["idTag"] = $idTag;
      $data["recipes"] = $recipes;
      $data["tags"] = $tags;
      return $this->twig->render("pages/recipes.html", $data);
  }
}
