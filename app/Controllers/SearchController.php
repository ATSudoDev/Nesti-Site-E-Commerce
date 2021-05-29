<?php

namespace App\Controllers;

//MODELS
use App\Models\ProductModel;
use App\Models\ArticleModel;
use App\Models\RecipeModel;

//ENTITIES

use App\Entities\Recipe;

class SearchController extends BaseController
{
    public function search()
    {
        helper('form');

        if ($this->request->getMethod() == 'post') {

            $keyword = filter_input(INPUT_POST, "searchArea", FILTER_SANITIZE_STRING);
           
            $recipeModel = new RecipeModel();
            $recipes = $recipeModel->searchRecipe($keyword);

            $resultRecipes = [];
            if (count($recipes) > 0){
                foreach($recipes as $recipe){
                    if ($recipe->state_recipe == "a"){
                        $resultRecipes[] = new Recipe(get_object_vars($recipe));
                    }
                }
            }

            $productModel = new ProductModel();
            $articleModel = new ArticleModel();
            $products = $productModel->searchProduct($keyword);

            $resultArticles = [];

            if (count($products) > 0){
                foreach($products as $product){
                    $articles = $articleModel->where('fk_id_product', $product->id_product)->where("state_article","a")->findAll();
                    foreach($articles as $article){
                        $resultArticles[] = $article;
                    }
                }
            }
        }
        
        $data["recipes"] = $resultRecipes;
        $data["articles"] =  $resultArticles;
       
        return $this->twig->render("pages/search.html", $data);
    }
}
