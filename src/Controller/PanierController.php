<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Produit;
use App\Entity\Commande;
use App\Entity\CommProd;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
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

    #[Route('/supprimerProduit/{productId}', name: 'app_supprimer_du_panier')]
    public function supprimerDuPanier(Request $request, int $productId): Response
    {
        // Récupérer le panier depuis la session
        $cart = $request->getSession()->get('cart', []);

        // Vérifier si le produit existe dans le panier
        if (isset($cart[$productId])) {
            // Si le produit existe, le supprimer du panier
            unset($cart[$productId]);

            // Mettre à jour le panier dans la session
            $request->getSession()->set('cart', $cart);

            // Répondre avec un message JSON pour indiquer que le produit a été supprimé avec succès
            return $this->json(['message' => 'Produit supprimé du panier.']);
        }

        // Si le produit n'existe pas dans le panier, renvoyer une erreur
        throw $this->createNotFoundException('Le produit n\'existe pas dans le panier.');
    }


    #[Route('/verifUser', name: 'app_verifUser')]
    public function getClientOrMessage(Security $security): Response
    {
        // Récupérer l'utilisateur connecté (client dans votre cas)
        $client = $security->getUser();

        // Vérifier si un client est connecté
        if ($client instanceof Client) {
            // Si un client est connecté, répondre avec les données du client sérialisées
            return $this->json([
                'client' => [
                    'id' => $client->getId(),
                    // Ajoutez d'autres informations du client ici selon votre structure d'objet
                ]
            ]);

        } else {
            return $this->json([
                'client' => [
                    'id' => null,
               'message' => 'Veuillez vous connecter pour commander.',
                    // Ajoutez d'autres informations du client ici selon votre structure d'objet
                ]
            ]);
            // Si aucun client n'est connecté, renvoyer un message

        }
    }

    #[Route('/AjoutCmd', name: 'app_ajoutCmd')]
    public function ajouterCommande(Security $security, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer les informations nécessaires pour créer une commande
        $session = $request->getSession();
        $cart = $session->get('cart'); // Supposons que le panier est stocké en session

        // Calculer le prix total en parcourant le panier
        $prixTotal = 0;
        foreach ($cart as $item) {
            $prixTotal += $item['prix_unit'] * $item['quantite']; // Adapter cette ligne selon la structure de votre panier
        }
        $client = $security->getUser();

        // Récupérer l'ID du client (vous devez obtenir cela selon votre logique)
        if ($client instanceof Client) {
            // Récupérez l'ID du client
            $clientId = $client->getId();

            $clientEntity = $entityManager->getRepository(Client::class)->find($clientId);
        
            $commande = new Commande();
            $commande->setCoClId($clientEntity);
            $commande->setCoDate(new \DateTime()); // Date actuelle
            $commande->setCoPrixTotal($prixTotal);

            // Enregistrer la commande en base de données
            $entityManager->persist($commande);
            $entityManager->flush();

            $commandeEntity = $entityManager->getRepository(Commande::class)->find($commande->getId());
            



            foreach($cart as $item)
            {
                $produitEntity = $entityManager->getRepository(Produit::class)->find($item['id']);
                $commProd = new CommProd();
                $commProd->setCpCoId($commandeEntity);
                $commProd->setCpPrId($produitEntity);
                $commProd->setCpQuantite($item['quantite']);
                $entityManager->persist($commProd);
                $entityManager->flush();
            }


                
            $session->remove('cart');
            $entityManager->flush();
    
            // Vous pouvez renvoyer une réponse appropriée, par exemple :
            return $this->json(['message' => 'succès']);
        } else {
            // Renvoyer une réponse JSON indiquant l'échec
            return $this->json(['message' => 'fail']);
        }
        // Créer une nouvelle commande

    }

    #[Route('/modifQte/{productId}/{qteIncrement}', name: 'app_change_qte')]
    public function changeQte(Request $request, int $productId, int $qteIncrement): Response
    {
        // Récupérer le panier depuis la session
        $cart = $request->getSession()->get('cart', []);
    
        // Vérifier si le produit est déjà dans le panier
        if (array_key_exists($productId, $cart)) {
            // Mettre à jour la quantité du produit
            $cart[$productId]['quantite'] += $qteIncrement;
    
            // Assurez-vous que la quantité ne devienne pas négative
            if ($cart[$productId]['quantite'] < 0) {
                $cart[$productId]['quantite'] = 0;
            }
    
            // Enregistrez le panier mis à jour dans la session
            $request->getSession()->set('cart', $cart);
        }
    
        // Vous pouvez rediriger vers une autre page ou renvoyer une réponse selon vos besoins
        // Redirection vers la page du panier par exemple
        return $this->json(['message' => 'succès']);    
    }
    

}