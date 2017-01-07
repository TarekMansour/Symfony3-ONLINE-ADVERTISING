<?php

namespace booksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('booksBundle:Default:index.html.twig');
    }

    public function loginAction()
    {
        return $this->render('booksBundle:Security:login.html.twig');
    }
    
}
