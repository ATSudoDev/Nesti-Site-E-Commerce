<?php

namespace App\Entities;

use CodeIgniter\Entity;

//MODELS
use App\Models\ArticleModel;

class Product extends Entity
{

    public function getPictureName(){
        $pictureName="no-image.jpg";
        $articleModel = new ArticleModel();
        $articles = $articleModel ->where("fk_id_product",$this->id_product)->findAll();
        
             if (count($articles) > 0 && $articles[0]!= null) {
                $pictureName = $articles[0]->getImageDir();
            } 
        
        return $pictureName;
    }

}
