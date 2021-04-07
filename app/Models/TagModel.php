<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{

    protected $table = 'tags'; // nom de la table
    protected $primaryKey = 'id_tag';
    protected $allowedFields = ['id_tag', 'tag_name']; // Nom des colonnes autorisées
    protected $returnType = 'App\Entities\Tag'; // Type de retour
    protected $useTimestamps = false; // Utilisation du timestamps

    protected $validationRules = [
        'tag_name' => 'required|alpha_numeric_space|min_length[3]',
        // 'slug' => 'required|alpha_numeric|min_length[2]|is_unique[tag.slug]',
    ];

    protected $validationMessages = [
        'slug' => [
            'is_unique' => 'Désolé. Ce tag est déjà pris. Veuillez en choisir un autre.'
        ]
    ];

    protected $skipValidation = false;
}
