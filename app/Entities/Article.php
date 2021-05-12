<?php

namespace App\Entities;

use CodeIgniter\Entity;

//MODELS
use App\Models\ImageModel;
use App\Models\PriceArticleModel;
use App\Models\ProductModel;
use App\Models\MeasureUnitModel;

class Article extends Entity
{
    public function getImage()
    {
        $imageModel = new ImageModel();
        $image = $imageModel->find($this->fk_id_image);
        return $image;
    }

    public function getPrice()
    {
        $priceArticleModel = new PriceArticleModel();
        $priceArticle = $priceArticleModel->find($this->id_article);
        return $priceArticle;
    }

    public function getProduct()
    {
        $productModel = new ProductModel();
        $product = $productModel->find($this->fk_id_product);
        return $product;
    }

    public function getMeasureUnit()
    {
        $measureUnitModel = new MeasureUnitModel();
        $measureUnit = $measureUnitModel->find($this->fk_id_measure_unit);
        return $measureUnit;
    }
}
