<?php

namespace booksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use booksBundle\Entity\Search;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class FrontEndController extends Controller
{
  
    public function catalogueAction()
    {
        return $this->render('booksBundle:frontEnd:catalogue.html.twig');
    }

    public function searchAction(Request $request)
    {
        $search = new Search();
        $fb = $this->createFormBuilder($search)
        ->add('searchField', TextType::class, array("label" => "What_are_you_looking_for?"))
        ->add('categories', ChoiceType::class, array(
                                                        'choices'  => array(
                                                        'All categories' => true,
                                                        '-- Books --' => null,
                                                        '-- Magazines --' => false,
                                                        '-- Movies --' =>false
                                                    )))
        ->add('region', ChoiceType::class, array(
                                                        'choices'  => array(
                                                        'All of Tunisia' => null,
                                                        'Ariana' => true,
                                                        'Béja' => true,
                                                        'Ben Arous' => true,
                                                        'Bizerte' => true,
                                                        'Gabès' => true,
                                                        'Gafsa' => true,
                                                        'Jendouba' => true,
                                                        'Kairouan' => true,
                                                        'Kébili' => true,
                                                        'La Manouba' => true,
                                                        'Le Kef' => true,
                                                        'Mahdia' => true,
                                                        'Médenine' => true,
                                                        'Nabeul' => true,
                                                        'Sfax' => true,
                                                        'Sidi Bouzid' => true,
                                                        'Siliana' => true,
                                                        'Sousse' => true,
                                                        'Tataouine' => true,
                                                        'Tozeur' => true,
                                                        'Tunis' => true,
                                                        'Zaghouan' => true,
                                                    )));
       //->add('Search',SubmitType::class, array('attr' => array('class' => 'btn btn-success')));


        // générer le formulaire à partir du FormBuilder
        $form = $fb->getForm();

        //Traitement de la validation du formulaire
        $form ->handleRequest($request); //handleRequest permet de récupérer le formulaire  
        if ($form -> isSubmitted() )//test de validiter de formulaire
        {
            //On hydrate notre objet
            $search = $form -> getData();
            //if ($form->get('categories')->isClicked()) {
                //return $this->redirect('http://symfony.com/doc');
                return $this->redirectToRoute('frontEnd_catalogue');
            

        }

        // Utiliser la méthode createView() pour que l'objet soit exploitable par la vue
        return $this->render('booksBundle:frontEnd:base_frontEnd.html.twig',
            array('f' => $form->createView()));
    }


    
}
