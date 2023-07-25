<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ParameterController extends AbstractController
{
    /**
     * @Route("/parameter/", name="parameter_index")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = $this->getUser();
        // je pré-remplis les formulaires avec les données de l'utilisateur qui est connecté
        $form = $this->createForm(UserType::class, $user);

        // ça hydrate mon formulaire depuis les données envoyés depuis le twig
        $form->handleRequest($request);

        // je check si le formulaire est soumis et qu'il est valide
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();


            // Entity manager sert à manipuler la base de donnée pour stocker les infos
            $em = $this->getDoctrine()->getManager();

            $em->flush();

            $this->addFlash('success', 'Votre modification à été prise en compte');

            return $this->redirectToRoute('espace_mes_biens');
        }



        return $this->render('parameter/index.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/parameter/archived", name="parameter_archived")
     */
    public function archived(): Response
    {
       // archivé l'utilisateur
        $user = $this->getUser();
        $user->setArchived(true);

        $this->getDoctrine()->getManager()->flush();

       // rediriger vers la page d'accueil avec message
        return $this->redirectToRoute('app_logout');
    }
}
