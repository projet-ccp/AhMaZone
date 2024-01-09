<?php

// src/Controller/OrderController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commande;

class OrderController extends AbstractController
{
    /**
     * @Route("/client/{clientId}/orders", name="client_orders")
     */
    public function listOrders($clientId)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($clientId);

        if (!$client) {
            throw $this->createNotFoundException('Client non trouvé');
        }

        $orders = $client->getOrders();

        return $this->render('order/list.html.twig', [
            'client' => $client,
            'orders' => $orders,
        ]);
    }
}

