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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class FormController extends AbstractController     
{
    // ...
 
    #[Route('/inscription')]
   public function index3(Request $request): Response
    {
 
        $myForm = $this->createFormBuilder()
            ->add('prenom', TextType::class, [
                'data' => '', // valeur par défaut
                'label' => 'nom :'
            ])
            ->add('nom', TextType::class, [
                'data' => '', // valeur par défaut
                'label' => 'Prénom :'
            ])
            ->add('email', EmailType::class, [
                'data' => '', // valeur par défaut
                'label' => 'email :'
            ])
            ->add('password', PasswordType::class, [
                'data' => '', // valeur par défaut
                'label' => 'mot de passe :'
            ])
            ->add('verif_password', PasswordType::class, [
                'data' => '', // valeur par défaut
                'label' => 'mot de passe confirmation:'
            ])
            ->add('adresse', PasswordType::class, [
                'data' => '', // valeur par défaut
                'label' => 'adresse:'
            ])
            ->add('codePost', PasswordType::class, [
                'data' => '', // valeur par défaut
                'label' => 'code postal:'
            ])
            ->add('ville', PasswordType::class, [
                'data' => '', // valeur par défaut
                'label' => 'ville:'
            ])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])
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
 