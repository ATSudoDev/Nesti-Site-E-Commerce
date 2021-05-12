<?php
namespace App\Entities;
use CodeIgniter\Entity;

//MODELS
use App\Models\MeasureUnitModel;
use App\Models\ProductModel;

class IngredientsRecipe extends Entity
{
    public function getMeasureUnit()
    {
        $measureUnitModel = new MeasureUnitModel();
        $measureUnit = $measureUnitModel->find($this->fk_id_measure_unit);
        return $measureUnit;
    }

    public function getProduct()
    {
        $productModel = new ProductModel();
        $product = $productModel->find($this->fk_id_product);
        return $product;
    }
   
}