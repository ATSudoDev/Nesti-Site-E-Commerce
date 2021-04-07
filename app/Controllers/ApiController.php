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

    public function category($cat)
    {
        $model = new RecipeModel();
        $recipes = $model->findCatForApi($cat);
        header('Content-Type: application/json');
        echo json_encode($recipes);
        die;
    }
}
