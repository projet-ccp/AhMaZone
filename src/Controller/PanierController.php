<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    
    #[Route('/panier/{productId}', name: 'app_ajouter_au_panier')]
    public function ajouterAuPanier(Request $request, int $productId): Response
    {
        // Récupérer les détails du produit depuis la base de données
        $product = $this->entityManager->getRepository(Produit::class)->find($productId);
    
        // Vérifier si le produit existe
        if (!$product) {
            throw $this->createNotFoundException('Le produit n\'existe pas.');
        }
    
        // Récupérer le panier depuis la session
        $cart = $request->getSession()->get('cart', []);
    
        // Vérifier si le produit est déjà dans le panier
        if (isset($cart[$productId])) {
            // Si le produit est déjà dans le panier, augmenter la quantité
            $cart[$productId]['quantite'] += 1;
    
            // Mettre à jour le prix unitaire en fonction de la nouvelle quantité
            $cart[$productId]['prix_unit'] = $product->getPrPrixUnit() * $cart[$productId]['quantite'];
        } else {
            // Si le produit n'est pas dans le panier, l'ajouter avec une quantité initiale de 1
            $cart[$productId] = [
                'id' => $product->getId(),
                'label' => $product->getPrLabel(),
                'prix_unit' => $product->getPrPrixUnit(),
                'quantite' => 1,
                'image' => $product->getPrImage(),
                // Ajoutez d'autres détails du produit au besoin
            ];
        }
    
        // Mettre à jour le panier dans la session
        $request->getSession()->set('cart', $cart);
    
        // Répondre avec un JSON pour indiquer le succès de l'ajout
        return $this->json(['message' => 'Produit ajouté au panier.']);
    }
    #[Route('/panier', name: 'app_panier')]
    public function voirPanier(Request $request): Response
    {
        $cart = $request->getSession()->get('cart', []);

        // Ici, vous pouvez transmettre $cart à votre vue pour l'afficher
        return $this->render('panier/panier.html.twig', [
            'cart' => $cart,
        ]);
    }
}
