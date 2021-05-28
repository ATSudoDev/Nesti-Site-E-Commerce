<?php

namespace App\Controllers;

// MODELS
use App\Models\RecipeModel;
use App\Models\IngredientsRecipeModel;
use App\Models\ParagraphModel;
use App\Models\CommentModel;
use App\Models\GradeModel;
use App\Models\TagModel;
use App\Models\TagHasRecipeModel;

// ENTITIES
use App\Entities\Comment;
use App\Entities\Grade;

class RecipesController extends BaseController
{
    /**
     * Get all recipes and tags
     */
    public function recipes()
    {
        helper('form');
        $recipeModel = new RecipeModel();
        $tagModel = new TagModel();

        $tags = $tagModel->findAll();
        $recipes = $recipeModel->where("state_recipe", "a")->findAll();

        $data["loc"] = "recipes";
        $data["recipes"] = $recipes;
        $data["tags"] = $tags;
        return $this->twig->render("pages/recipes.html", $data);
    }

    /**
     * Get the recipe information
     */
    public function recipe($idRecipe)
    {
        helper('form');

        $recipeModel = new RecipeModel();
        $ingredientsRecipeModel = new IngredientsRecipeModel();
        $paragraphModel = new ParagraphModel();
        $commentModel = new CommentModel();

        $recipe = $recipeModel->find($idRecipe); 
        $listIngredients = $ingredientsRecipeModel->where('fk_id_recipe', $idRecipe)->findAll(); 
        $listParagraphs = $paragraphModel->where('fk_id_recipes', $idRecipe)->orderBy('order_paragraph', 'asc')->findAll(); 
        $listComments = $commentModel->where("fk_id_recipe", $idRecipe)->where("state_comment", "a")->findAll();

        $data["loc"] = "recipe";
        $data["recipe"] = $recipe;
        $data["ingredientsRecipe"] = $listIngredients;
        $data["paragraphs"] = $listParagraphs;
        $data["comments"] = $listComments;
        return $this->twig->render("pages/recipe.html", $data);
    }

    /**
     * Add comme to one the recipe
     */
    public function recipeComment($idRecipe)
    {
        $data = [];
        $data["success"] = false;
        $data['csrf_token'] = csrf_hash();
        helper('form');

        $data['validation'] = [];

        if ($this->request->getMethod() == 'post') {

            $validation = \Config\Services::validation();

            $validation->setRules(
                [
                    'title-comment' => 'required',
                    'content-comment' => 'required',
                ],
                [   // Errors
                    'title-comment' => [
                        'required' => "Veuillez un titre"
                    ],
                    'content-comment' => [
                        'required' => "Veuillez saisir un texte"
                    ],

                ]
            );

            $check = $validation->withRequest($this->request)->run();

            if (!$check) {
                $data['validation'] = $validation->getErrors();
            } else {

                $commentModel = new CommentModel();
                $id_user =  $this->session->get('id');
                $result =  $commentModel->where('fk_id_recipe', $idRecipe)->where('fk_id_user', $id_user)->find();



                if (empty($result)) {

                    $title_comment = $this->request->getPost('title-comment');
                    $content_comment = $this->request->getPost('content-comment');

                    $newComment = new Comment();
                    $newComment->fill([
                        'title_comment' => $title_comment,
                        'content_comment' => $content_comment,
                        'state_comment' => 'w',
                        'fk_id_recipe' => $idRecipe,
                        'fk_id_user' =>  $id_user,
                    ]);

                    $commentModel->insert($newComment);

                    $data["success"] = true;
                } else {

                    $data['validation'] = ['already'];
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        die;
    }

    /**
     * Add comme to one the recipe
     */
    public function recipeGrade($idRecipe)
    {
        $data = [];
        $data["success"] = false;
        $data['csrf_token'] = csrf_hash();
        helper('form');

        $data['validation'] = [];

        if ($this->request->getMethod() == 'post') {

            $gradeModel = new GradeModel();
            $id_user =  $this->session->get('id');
            $result =  $gradeModel->where('fk_id_recipe', $idRecipe)->where('fk_id_user', $id_user)->find();

            if (empty($result)) {

                $grade = $this->request->getPost('grade');

                $newGrade = new Grade();
                $newGrade->fill([
                    'grade_out_of_5' =>  $grade,
                    'fk_id_recipe' => $idRecipe,
                    'fk_id_user' =>  $id_user,
                ]);

                $gradeModel->insert($newGrade);

                $grades = $gradeModel->where('fk_id_recipe', $idRecipe)->findAll();
                $numberGrades = 0;
                $totalGrades = 0;
                foreach ($grades as $grade) {
                    $totalGrades += $grade->grade_out_of_5;
                    $numberGrades++;
                }
                 $averageGrade = ($totalGrades /  $numberGrades);
                
                $data["averageGrade"] = $averageGrade ;
                $data["numberGrades"] = $numberGrades;
                $data["success"] = true;
            } else {
                $data['validation'] = ['already'];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        die;
    }
}
