<?php

namespace App\Controllers;

// MODELS
use App\Models\IngredientsRecipeModel;
use App\Models\ProductModel;
use App\Models\IngredientModel;
use App\Models\RecipeModel;
use App\Models\TagModel;

// ENTITIES

class SuggestionsController extends BaseController
{
    public function suggestions()
    {
        helper('form');

        $productModel = new ProductModel();
        $ingredientModel = new IngredientModel();

        $ingredients = $ingredientModel->findAll();

        $products = [];
        foreach ($ingredients as $ingredient) {
            $products[] = $productModel->find($ingredient->fk_product_ingredient);
        }

        usort($products, function ($r1, $r2) {
            return $r1->name_product <=> $r2->name_product;
        });

        $resultsIngredient = [];
        foreach ($products as $product) {
            $resultIngredient = (object)[];
            $resultIngredient->ingredientId = $product->id_product;
            $resultIngredient->name = $product->name_product;
            $resultIngredient->url = $product->getPictureName();
            $resultsIngredient[] = $resultIngredient;
        }

        $model = new RecipeModel();
        $recipes = $model->findAll();

        $ingredientRecipeModel = new IngredientsRecipeModel();

        $resultsRecipe = [];
        foreach ($recipes as $recipe) {
            $resultRecipe = (object)[];
            $resultRecipe->recipeId = $recipe->id_recipe;

            $ingredientsRecipes = $ingredientRecipeModel->where('fk_id_recipe', $recipe->id_recipe)->findAll();
            
            $listNameIngredients = [];
            foreach ($ingredientsRecipes as $ingredientRecipe) {
                $listNameIngredients[] = $ingredientRecipe->getProduct()->name_product;
            }

            $resultRecipe->ingredients = $listNameIngredients;
            
            $resultsRecipe[] = $resultRecipe;
        }

        $data["ingredientsJSON"] = $resultsIngredient;
        $data["recipesJSON"] = $resultsRecipe;
        $data["loc"] = "suggestions";

        return $this->twig->render("pages/suggestions.html", $data);
    }

    public function recipes()
    {
        helper('form');
        $tagModel = new TagModel();
   
        $tags = $tagModel->findAll();

        $recipeModel = new RecipeModel();

        $validRecipes = json_decode($this->request->getPost('validRecipes')); // get the validRecipes

        $recipes=[];
        foreach($validRecipes as $validRecipe){
            $recipes[]= $recipeModel->find($validRecipe->recipeId);
        }

        $data["loc"] = "Recipes";
        $data["tags"] = $tags;
        $data["recipes"] = $recipes;
        return $this->twig->render("pages/recipes.html", $data);
    }
}
