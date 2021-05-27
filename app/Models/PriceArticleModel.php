<?php

namespace App\Models;

use CodeIgniter\Model;

class PriceArticleModel extends Model
{
    protected $table = 'price_articles'; 
    protected $primaryKey = 'id_price_article'; 
    protected $allowedFields = ['id_price_article', 'date_app_price_article', 'price_article', 'fk_id_article']; 
    protected $returnType = 'App\Entities\PriceArticle';

    public function getLastPrice($idArticle){
        $query = $this->db->query('SELECT price_article FROM price_articles WHERE fk_id_article="' . $idArticle . '" ORDER BY date_app_price_article DESC LIMIT 1');
        return $query->getResult();
    }
}
