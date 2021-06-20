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

            
            foreach ($recipes as $recipe){
                
                $model = new RecipeModel();
                $ingredients = $model->findIngredientRecipeForApi($recipe->id_recipe);
                $steps = $model->findStepsRecipeForApi($recipe->id_recipe);
               
                $recipe->ingredients = $ingredients;
                $recipe->steps = $steps;
            }

            usort($recipes, function ($r1, $r2) {
                return $r1->id_recipe <=> $r2->id_recipe;
            });

            $logTokenModel = new TokenLogModel();

            $log_token = new LogToken();
            $log_token->fill([
                'fk_id_token' => $tokenDB[0]->id_token,
                'from_where'  => $tokenDB[0]->application
            ]);
           
            $logTokenModel->insert($log_token);

            echo json_encode($recipes);

         } else {
            echo json_encode("Le token est invalide");
        }

        die;
    }

    // Find recipe by ID
    public function recipe($token, $id)
    {

        $tokenModel = new TokenModel();
        $tokenDB = $tokenModel->where('value_token', $token)->find();
        header('Content-Type: application/json');
        
        // If the token is right, find data
        if ($tokenDB != null) {

            $model = new RecipeModel();
            $recipes = $model->find($id);
            
            if ($recipes != null) {

                $ingredients = $model->findIngredientRecipeForApi($id);
                $steps = $model->findStepsRecipeForApi($id);
                
                $recipes->ingredients = $ingredients;
                $recipes->steps = $steps;

                // Add log token in the DB
                $logTokenModel = new TokenLogModel();

                $log_token = new LogToken();
                $log_token->fill([
                    'fk_id_token' => $tokenDB[0]->id_token,
                    'from_where'  => $tokenDB[0]->application
                ]);
                $logTokenModel->insert($log_token);

                echo json_encode($recipes);

            } else {
                // If the recipe doesn't exist, error message
                echo json_encode("La recette n'existe pas");
            }
        
        } else {
            // If the token is wrong, error message
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
            'fk_id_token' => $tokenDB[0]->id_token,
            'from_where'  => $tokenDB[0]->application
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
            'fk_id_token' => $tokenDB[0]->id_token,
            'from_where'  => $tokenDB[0]->application
        ]);
    
        $logTokenModel->insert($log_token);

        echo json_encode($recipes);
       
    } else {

            echo json_encode("Le token est invalide");
        }
        
        die;
    }


}
