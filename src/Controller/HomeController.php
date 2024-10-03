<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    //les 2 routes pour bien tomber sur la page d'acceuil meme sans ecrire home. 
    #[Route('/home', name: 'home'), Route('/', name: 'homme')]
    public function index(): Response
    {
        return $this->render('home.html.twig');
    }
}