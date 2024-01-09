<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    #[Route('/produits', name: 'app_produit')]
    public function listProducts(ProduitRepository $produitRepository): Response
    {
        $products = $produitRepository->findAll();

        return $this->render('produit/produits.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/produit/{id}', name: 'show_product')]
    public function showProduct($id, ProduitRepository $produitRepository): Response
    {
        $product = $produitRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Le produit n\'existe pas.');
        }

        return $this->render('produit/produit.html.twig', [
            'product' => $product,
        ]);
    }

    public function addToCart(Request $request, int $productId): Response
    {
        // Récupérer les détails du produit depuis la base de données
        $product = $this->getDoctrine()->getRepository(Produit::class)->find($productId);

        // Vérifier si le produit existe
        if (!$product) {
            throw $this->createNotFoundException('Le produit n\'existe pas.');
        }

        // Ajouter le produit au panier (dans la session)
        $cart = $request->getSession()->get('cart', []);
        $cart[$productId] = [
            'id' => $product->getId(),
            'label' => $product->getPrLabel(),
            // Ajoutez d'autres détails du produit au besoin
        ];

        $request->getSession()->set('cart', $cart);

        // Répondre avec un JSON pour indiquer le succès de l'ajout
        return $this->json(['message' => 'Produit ajouté au panier.']);
    }



}
