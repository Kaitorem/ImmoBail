<?php

namespace App\Controller;

use App\Contante\DocumentConstant;
use App\Entity\Image;
use App\Entity\Locataire;
use App\Entity\Location;
use App\Form\LocationType;
use App\Repository\LocationRepository;
use App\Repository\LoyerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espace", name="espace_")
 */
class EspaceClientController extends AbstractController
{
    /** @Route("/mes-biens", name="mes_biens") */
    public function index(Request $request, LocationRepository $locationRepository): Response
    {
        $locations = $locationRepository->findBy(['user' => $this->getUser(), 'archived' => false]);

        return $this->render('espace_client/index.html.twig', [
            'locations' => $locations,
        ]);
    }

    /** @Route("/ajouter", name="ajouter_bien") */
    public function add(Request $request): Response
    {
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if ($image = $form->get('image')->getData()) {
                $image->setName(uniqid());
            }

            if ($locataire = $form->get('locataire')->getData()) {
                $locataire->setLocation($location);
                $em->persist($locataire);
            }
            $location->setUser($this->getUser());

            if ($image = $location->getImage()) {
                $image->setLocation($location);
            }

            if ($location->getImage()) {
                $em->persist($location->getImage());
            }
            $em->persist($location);
            $em->flush();

           return $this->redirectToRoute('espace_mes_biens');
        }

        return $this->render('espace_client/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /** @Route("/{id}/detail", name="voir_bien") */
    public function show(Request $request, Location $location, LoyerRepository $loyerRepository): Response
    {
        return $this->render('espace_client/show.html.twig', [
            'location' => $location,
            'loyers' => $loyerRepository->findBy(['location' => $location])
        ]);
    }


    /**
     * @Route("/{id}/edit", name="location_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Location $location): Response
    {
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Le bien à bien été modifiée');

            return $this->redirectToRoute('espace_mes_biens', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('location/edit.html.twig', [
            'location' => $location,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="location_delete", methods={"POST", "GET"})
     */
    public function delete(Request $request, Location $location): Response
    {
        $location->setArchived(true);

        $this->addFlash('success', 'Le bien à bien été supprimé');

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('espace_mes_biens');
    }
}
