<?php

namespace App\Controllers;

// MODELS
use App\Models\RecipeModel;

class HomeController extends BaseController
{
    /**
     * Get most famous recipes
     */
    public function home()
    {
        helper('form');
        $recipeModel = new RecipeModel();

        $recipes = $recipeModel->where("state_recipe", "a")->findAll();

        $top3Recipes = [];

        foreach ($recipes as $recipe) {

            $recipeWithGrade = (object)[];
            $recipeWithGrade->id_recipe = $recipe->id_recipe;
            $recipeWithGrade->name = $recipe->name_recipe;
            $recipeWithGrade->difficulty = $recipe->difficulty_recipe;
            $recipeWithGrade->numberPerson = $recipe->number_person_recipe;
            $recipeWithGrade->time = $recipe->time_recipe;
            $recipeWithGrade->image = $recipe->getImageDir();
            $recipeWithGrade->averageGrade = $recipe->getAverageGrade();
            $recipeWithGrade->numberGrades = $recipe->getNumberGrade();
            $top3Recipes [] = $recipeWithGrade;
        }

        usort($top3Recipes, function ($r1, $r2) {
            return $r2->averageGrade <=> $r1->averageGrade;
        });

        $resultRecipes = [];
        $resultRecipes = array_slice($top3Recipes, 0, 3);

        $data["loc"] = "home";
        $data["recipes"] = $resultRecipes;

        return $this->twig->render("pages/home.html", $data);
    }
}
