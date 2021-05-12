<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'id_tag';
    protected $allowedFields = ['id_tag', 'tag_name'];
    protected $returnType = 'App\Entities\Tag';

}
