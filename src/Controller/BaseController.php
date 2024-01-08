<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function base(): Response
    {
        return $this->render('base.html.twig');
    }

    #[Route('/form', name: 'app_form')]
    public function accueil(): Response
    {
        return $this->render('form/form.html.twig');
    }

    #[Route('/formconnexion', name: 'app_formconnexion')]
    public function connexion(): Response
    {
        return $this->render('formconnexion/formconnexion.html.twig');
    }

    
    
    

}
