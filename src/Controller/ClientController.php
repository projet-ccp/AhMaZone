<?php

// src/Controller/ClientController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;


class ClientController extends AbstractController
{
    public function listClients()
    {
        $clients = $this->getDoctrine()->getRepository(Client::class)->findAll();

        return $this->render('client/list.html.twig', [
            'clients' => $clients,
        ]);
    }
}

