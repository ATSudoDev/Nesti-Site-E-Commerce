<?php
namespace App\Entities;
use CodeIgniter\Entity;

//MODELS
use App\Models\ImageModel;
use App\Models\GradeModel;

class Recipe extends Entity
{

    public function getImage()
    {
        $imageModel = new ImageModel();
        $image = $imageModel->find($this->fk_id_image);
        return $image;
    }

    public function getNumberGrade()
    {
        $gradeModel = new GradeModel();
        $numberGrade = $gradeModel->where('fk_id_recipe', $this->id_recipe)->findAll();

        return count($numberGrade);
    }

    public function getAverageGrade()
    {
      
        $gradeModel = new GradeModel();
        $grades = $gradeModel->where('fk_id_recipe', $this->id_recipe)->findAll();

        $numberGrades = 0;
        $totalGrades = 0;
        foreach ($grades as $grade) {
            $totalGrades += $grade->grade_out_of_5;
            $numberGrades++;
        }

        if ( $numberGrades != 0){
            $averageGrade = ($totalGrades /  $numberGrades);
        } else {
            $averageGrade = 0;
        }
        return $averageGrade;
    }

}