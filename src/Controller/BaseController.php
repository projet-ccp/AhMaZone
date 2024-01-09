<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;

class BaseController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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

    #[Route('/clients', name: 'client_list')]
    public function listClients(): Response
    {
        $clients = $this->entityManager->getRepository(Client::class)->findAll();

        return $this->render('client/list.html.twig', [
            'clients' => $clients,
        ]);
    }
}
