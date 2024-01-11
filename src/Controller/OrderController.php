<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use App\Entity\Produit;

class OrderController extends AbstractController
{
    #[Route('/client/{clientId}/orders', name: 'client_orders')]
    public function listClientOrders($clientId,int $productId): Response
    {
        $client = $this->entityManager->getRepository(Client::class)->find($clientId);

        if (!$client) {
            throw $this->createNotFoundException('Client non trouvé');
        }

        $orders = $this->entityManager->getRepository(Produit::class)->find($productId);

        return $this->render('order/list.html.twig', [
            'client' => $client,
            'orders' => $orders,
        ]);
    }
}



