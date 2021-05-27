<?php

namespace App\Controllers;

//MODELS


// ENTITIES


class BasketController extends BaseController
{

    public function basket()
    {

        


        return $this->twig->render("pages/basket.html", $data);
    }



}