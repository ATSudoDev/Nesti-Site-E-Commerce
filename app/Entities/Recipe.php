<?php
namespace App\Entities;
use CodeIgniter\Entity;


class Recipe extends Entity
{
    protected $attributes = [
        'id_recipe' => null,
        'date_creation_recipe' => null,        
        'name_recipe' => null,
        'difficulty_recipe' => null,
        'number_person_recipe' => null,
        'state_recipe' => null,
        'time_recipe' => null,
        'fk_id_image' => null,
        'fk_id_chief' => null,
        'ingredients' => null,
        'steps' => null,
        
    ];
   
}