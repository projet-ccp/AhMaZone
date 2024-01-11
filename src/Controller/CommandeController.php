<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\CommProd;
use Doctrine\ORM\Mapping\Id;
use App\Repository\ProduitRepository;
use App\Repository\CommandeRepository;
use App\Repository\CommProdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Route('/commandes/{clientId}', name: 'afficher_commandes')]
    public function afficherCommandes(EntityManagerInterface $entityManager, int $clientId, CommandeRepository $commandeRepository): Response
    {
        $client = $entityManager->getRepository(Client::class)->find($clientId);

        if (!$client) {
            throw $this->createNotFoundException('Client non trouvé');
        }
        
        $clientIdString = strval($clientId);

        $commandes = $commandeRepository->findBy(['co_cl_id' => $clientIdString]);

        $monTableauVide = [];

        // Créer une réponse JSON avec le tableau vide $produits = [];
    $commProd = [];
    $produits = [];
    
        return $this->render('order/order.html.twig', [
            'client' => $client,
            'commandes' => $commandes,
        ]);
    }

    #[Route('/commandes/{clientId}/{commId}', name: 'afficher_commandes_prod')]
    public function afficherCommandesProduit(string $commId, CommProdRepository $commProdRepository, ProduitRepository $produitRepository): Response
    {
        $commProd = $commProdRepository->findBy(['cp_pr_id' => $commId]);
        $produits = []; // Initialisez la variable $produits en dehors de la boucle
    
        foreach ($commProd as $unProd) {
            $idProd = strval($unProd->getId());
            $produit = $produitRepository->find($idProd);
    
            if ($produit) {
                $produits[] = $produit;
            }
        }
    
        return $this->render('order/produit.html.twig', [
            'commprod' => $commProd,
            'produits' => $produits,
        ]);
    }
    
    
    
    



}