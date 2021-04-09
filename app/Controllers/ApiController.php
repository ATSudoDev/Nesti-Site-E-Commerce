<?php

namespace App\Controllers;

use App\Models\RecipeModel;

class ApiController extends BaseController
{
    public function index()
    {
        return view('api_help');
    }

    public function recipes()
    {
        $model = new RecipeModel();
        $recipes = $model->findAllForApi();
        header('Content-Type: application/json');
        echo json_encode($recipes);
        die;
    }

    
    public function recipe($id)
    {
        $model = new RecipeModel();
        $recipes = $model->find($id);

        $model = new RecipeModel();
        $ingredients = $model->findIngredientRecipeForApi($id);

        $model = new RecipeModel();
        $steps = $model->findStepsRecipeForApi($id);
        
        $recipes->ingredients = $ingredients;
        $recipes->steps = $steps;

        header('Content-Type: application/json');
        echo json_encode($recipes);
        die;
    }

    public function category($cat)
    {
        $model = new RecipeModel();
        $recipes = $model->findCatForApi($cat);
        header('Content-Type: application/json');
        echo json_encode($recipes);
        die;
    }

    public function ingredients($id)
    {
        $model = new RecipeModel();
        $recipes = $model->findIngredientRecipeForApi($id);
        header('Content-Type: application/json');
        echo json_encode($recipes);
        die;
    }

    public function steps($id)
    {
        $model = new RecipeModel();
        $recipes = $model->findStepsRecipeForApi($id);
        header('Content-Type: application/json');
        echo json_encode($recipes);
        die;
    }


}
