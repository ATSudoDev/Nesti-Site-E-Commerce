<?php

namespace App\Controllers;

class PagesController extends BaseController
{
    public function index()
    {
        $data["loc"] = "home";
        return $this->twig->render("pages/home.html", $data);
    }

    public function home()
    {
        $data["loc"] = "home";
        return $this->twig->render("pages/home.html", $data);
    }

    public function recipes()
    {
        $data["loc"] = "recipes";
        return $this->twig->render("pages/recipes.html", $data);
    }

    public function suggestions()
    {
        $data["loc"] = "suggestions";
        return $this->twig->render("pages/suggestions.html", $data);
    }

    public function market()
    {
        $data["loc"] = "market";
        return $this->twig->render("pages/market.html", $data);
    }

    public function basket()
    {
        $data["loc"] = "basket";
        return $this->twig->render("pages/basket.html", $data);
    }

    public function user()
    {
        $data["loc"] = "user";
        return $this->twig->render("pages/user.html", $data);
    }
}