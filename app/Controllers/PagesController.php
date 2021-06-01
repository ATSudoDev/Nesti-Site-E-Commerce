<?php

namespace App\Controllers;

// MODELS
use App\Models\RecipeModel;

class PagesController extends BaseController
{
    public function index()
    {
        $data["loc"] = "home";

        helper('form');
        $recipeModel = new RecipeModel();

        $recipes = $recipeModel->where("state_recipe", "a")->findAll();

        $top4Recipes = [];

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
            $top4Recipes[] = $recipeWithGrade;
        }

        usort($top4Recipes, function ($r1, $r2) {
            return $r2->averageGrade <=> $r1->averageGrade;
        });

        $resultRecipes = [];
        $resultRecipes = array_slice($top4Recipes, 0, 4);

        $data["loc"] = "home";
        $data["recipes"] = $resultRecipes;

        return $this->twig->render("pages/home.html", $data);
    }

    public function home()
    {
        $data["loc"] = "home";
        return $this->twig->render("pages/home.html", $data);
    }

    public function recipes()
    {
        $data["loc"] = "recipes";
        return $this->twig->render("pages/recipes.html", $data);
    }

    public function suggestions()
    {
        $data["loc"] = "suggestions";
        return $this->twig->render("pages/suggestions.html", $data);
    }

    public function market()
    {
        $data["loc"] = "market";
        return $this->twig->render("pages/market.html", $data);
    }

    public function basket()
    {
        $data["loc"] = "basket";
        return $this->twig->render("pages/basket.html", $data);
    }

    public function user()
    {
        $data["loc"] = "user";
        return $this->twig->render("pages/user.html", $data);
    }
}
