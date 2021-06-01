<?php

namespace App\Controllers;

// MODELS 
use App\Models\RecipeModel;
use App\Models\TokenModel;
use App\Models\TokenLogModel;

//ENTITIES
use App\Entities\LogToken;

class ApiController extends BaseController
{

    public function recipes($token)
    {
        $tokenModel = new TokenModel();
        $tokenDB = $tokenModel->where('value_token', $token)->find();
        header('Content-Type: application/json');
        
        if ($tokenDB != null) {
            
            $model = new RecipeModel();
            $recipes = $model->findAllForApi();

            $logTokenModel = new TokenLogModel();

            $log_token = new LogToken();
            $log_token->fill([
                'fk_id_token' => $tokenDB[0]->id_token
            ]);
            $logTokenModel->insert($log_token);

            echo json_encode($recipes);

         } else {
            echo json_encode("Le token est invalide");
        }

        die;
    }

    public function recipe($token, $id)
    {

        $tokenModel = new TokenModel();
        $tokenDB = $tokenModel->where('value_token', $token)->find();
        header('Content-Type: application/json');
        
        if ($tokenDB != null) {

        $model = new RecipeModel();
        $recipes = $model->find($id);

        $model = new RecipeModel();
        $ingredients = $model->findIngredientRecipeForApi($id);

        $model = new RecipeModel();
        $steps = $model->findStepsRecipeForApi($id);
        
        $recipes->ingredients = $ingredients;
        $recipes->steps = $steps;

        $logTokenModel = new TokenLogModel();

        $log_token = new LogToken();
        $log_token->fill([
            'fk_id_token' => $tokenDB[0]->id_token
        ]);
        $logTokenModel->insert($log_token);

        echo json_encode($recipes);
        
    } else {
        echo json_encode("Le token est invalide");
    }
        
        die;
    }

    public function category($token, $cat)
    {

        $tokenModel = new TokenModel();
        $tokenDB = $tokenModel->where('value_token', $token)->find();
        header('Content-Type: application/json');
        
        if ($tokenDB != null) {

        $model = new RecipeModel();
        $recipes = $model->findCatForApi($cat);

        $logTokenModel = new TokenLogModel();

        $log_token = new LogToken();
        $log_token->fill([
            'fk_id_token' => $tokenDB[0]->id_token
        ]);
        $logTokenModel->insert($log_token);

        echo json_encode($recipes);
        
    } else {
        echo json_encode("Le token est invalide");
    }
        
        die;
    }


    public function search($token, $keyword){

        $tokenModel = new TokenModel();
        $tokenDB = $tokenModel->where('value_token', $token)->find();
        header('Content-Type: application/json');
        
        if ($tokenDB != null) {

        $recipeModel = new RecipeModel();
        $recipes = $recipeModel->findSearchRecipeForApi($keyword);

        $logTokenModel = new TokenLogModel();

        $log_token = new LogToken();
        $log_token->fill([
            'fk_id_token' => $tokenDB[0]->id_token
        ]);
        $logTokenModel->insert($log_token);

        echo json_encode($recipes);
       
    } else {

            echo json_encode("Le token est invalide");
        }
        
        die;
    }


}
