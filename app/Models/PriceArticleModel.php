<?php

namespace App\Models;

use CodeIgniter\Model;

class PriceArticleModel extends Model
{
    protected $table = 'price_articles'; 
    protected $primaryKey = 'id_price_article'; 
    protected $allowedFields = ['id_price_article', 'date_app_price_article', 'price_article', 'fk_id_article']; 
    protected $returnType = 'App\Entities\PriceArticle';

}
