<?php

namespace App\Models;

use CodeIgniter\Model;

class ParagraphModel extends Model
{
    protected $table = 'paragraphs'; 
    protected $primaryKey = 'id_paragraph'; 
    protected $allowedFields = ['id_paragraph', 'content_paragraph', 'order_paragraph', 'data_creation_paragraph', 'fk_id_recipes']; 
    protected $returnType = 'App\Entities\Paragraph';

}
