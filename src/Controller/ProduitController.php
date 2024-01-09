<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
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

}
