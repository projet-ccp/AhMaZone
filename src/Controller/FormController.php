<?php
 
namespace App\Controller;
 
use Person;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
class FormController extends AbstractController
{
    // ...
 
    #[Route('/form')]
   public function index3(Request $request): Response
    {
        $person = new Person( "Jean", true);
 
        $myForm = $this->createFormBuilder($person)
            ->add('first_name', TextType::class, [
                'data' => 'Jean', // valeur par défaut
                'label' => 'Prénom :'
            ])
            ->add('genre', CheckboxType::class, [
                'label' => 'Masculin',
                'required' => false
            ])
            ->add('Commentaire', TextType::class, [
                'mapped' => false
            ])
            ->add('submit', SubmitType::class, ['label' => 'Soumettre'])
            ->getForm();
 
        $myForm->handleRequest($request);
 
        if ($myForm->isSubmitted() && $myForm->isValid()) {
            dump($request);
            dd($person);
        }
 
        return $this->render('form/form.html.twig', [
            'myForm' => $myForm->createView()
        ]);
    }
 
 
}
?>
 