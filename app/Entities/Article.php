<?php

namespace App\Entities;

use CodeIgniter\Entity;

//MODELS
use App\Models\ImageModel;
use App\Models\PriceArticleModel;
use App\Models\ProductModel;
use App\Models\MeasureUnitModel;
use App\Models\PackageModel;
use App\Models\CommandLineModel;

class Article extends Entity
{

    public function getName()
    {
        $name = $this->quantity_unite_article . " " . $this->getMeasureUnit()->name_measure_unit . " de " . $this->getProduct()->name_product;
        return $name;
    }

    public function getImage()
    {
        $imageModel = new ImageModel();

       if ($this->fk_id_image != null ) {
        $image = $imageModel->find($this->fk_id_image);
       } else {
        $image = $imageModel->find(1);
       }
        return $image;
    }

    public function getImageDir()
    {
        $nameImage = $this->getImage()->name_image;
        $extensionImage = $this->getImage()->extension_image;
        
        $imageDir ='';
        if($nameImage != null && $extensionImage != null) {
            $imageDir = $nameImage . "." .  $extensionImage;
        }
        
        return $imageDir;
    }

    public function getPrice()
    {
        $priceArticleModel = new PriceArticleModel();
        $priceArticle = $priceArticleModel->getLastPrice($this->id_article);
        return $priceArticle[0]->price_article;
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

    public function getStock()
    {
        $packageModel = new PackageModel();
        $packages =  $packageModel->where('fk_id_article', $this->id_article)->findAll();
       
        $numberBought = 0;
        foreach ($packages as $package) {
            $numberBought += $package->quantity_bought_package;
        }

        $commandModel = new CommandLineModel();
        $commands =  $commandModel->where('fk_id_article', $this->id_article)->findAll();
      
        $numberSold = 0;
        foreach ( $commands as  $command) {
            $numberSold +=  $command->command_quantity;
        }

        $stock = 0;
        $stock = $numberBought - $numberSold;

        return $stock;
    }

}
