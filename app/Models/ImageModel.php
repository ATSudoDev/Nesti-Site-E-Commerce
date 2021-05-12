<?php

namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id_image';
    protected $allowedFields = ['id_image', 'date_creation_image', 'name_image', 'extension_image'];
    protected $returnType = 'App\Entities\Image'; 

}