<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        return view('welcome_message.php');
    }

    public function home()
    {
        $this->renderTemplate("pages/home");
    }

    public function about()
    {
        $this->renderTemplate("pages/about");
    }

    public function test()
    {
        $this->renderTemplate("pages/test");
    }
}