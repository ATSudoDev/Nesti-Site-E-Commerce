<?php

namespace App\Controllers;

// MODELS
use App\Models\ArticleModel;
use App\Models\RecipeModel;
use App\Models\IngredientsRecipeModel;

class MarketController extends BaseController
{
    /**
     * Get all recipes and tags
     */
    public function market()
    {
        helper('form');
        $articleModel = new ArticleModel();
        $articles = $articleModel->where("state_article","a")->findAll();

        $data["loc"] = "market";
        $data["articles"] = $articles;
        return $this->twig->render("pages/market.html", $data);
    }

      /**
     * Get the recipe information
     */
    public function article($idArticle)
    {
        helper('form');
        $articleModel = new ArticleModel();
        $ingredientsRecipeModel = new IngredientsRecipeModel();
        $recipeModel = new RecipeModel();
     
        $article = $articleModel->find($idArticle);
        $idProduct= $article->getProduct()->id_product;

        $recipesWithIngredient = $ingredientsRecipeModel->where("fk_id_product",$idProduct)->findAll();

        $recipes = [];
        foreach($recipesWithIngredient as $recipe){
          $recipes =  $recipeModel->where("id_recipe", $recipe->fk_id_recipe)->find();
        }
       
        $data["loc"] = "market";
        $data["article"] = $article;
        $data["recipes"] = $recipes;
     
        return $this->twig->render("pages/article.html", $data);
    }


}