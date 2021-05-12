<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id_article';
    protected $allowedFields = ['id_article', 'customer_name_article', 'quantity_unite_article', 'state_article', 'date_creation_article', 'fk_id_product', 'fk_id_image', 'fk_id_measure_unit'];
    protected $returnType = 'App\Entities\Article';

}