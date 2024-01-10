<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use App\Entity\Produit;

class OrderController extends AbstractController
{
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



