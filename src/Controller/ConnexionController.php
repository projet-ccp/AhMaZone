<?php
 
namespace App\Controller;
 
use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
class ConnexionController extends AbstractController
{
    // ....
   
    #[Route('/connexion')]
   public function index2(Request $request): Response
    {
 
        if ($request->getMethod() == "POST") {
            dump($request);
        }
 
        $myForm = $this->createFormBuilder()
            ->add('email', TextType::class, [
                'data' => '', // valeur par défaut
                'label' => 'email :'
            ])
            ->add('password', TextType::class, [
                'data' => '', // valeur par défaut
                'label' => 'mot de passe :'
            ])
            ->add('submit', SubmitType::class, ['label' => 'Connexion'])
            ->getForm();
 
        // gérer les données soumises
        $myForm->handleRequest($request);
 
        // validation
        if ($myForm->isSubmitted() && $myForm->isValid()) {
            dd($myForm->getData());
            // sauvegarder dans la base de données par exemple
        }
 
        return $this->render('connexion.html.twig', [
            'myForm' => $myForm->createView()
        ]);
    }
   
}
