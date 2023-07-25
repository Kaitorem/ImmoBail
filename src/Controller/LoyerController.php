<?php

namespace App\Controller;

use App\Entity\Loyer;
use App\Form\LoyerType;
use App\Repository\LoyerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/loyer")
 */
class LoyerController extends AbstractController
{
    /**
     * @Route("/", name="loyer_index", methods={"GET"})
     */
    public function index(LoyerRepository $loyerRepository): Response
    {
        return $this->render('loyer/index.html.twig', [
            'loyers' => $loyerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="loyer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $loyer = new Loyer();
        $form = $this->createForm(LoyerType::class, $loyer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($loyer);
            $entityManager->flush();

            return $this->redirectToRoute('loyer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('loyer/new.html.twig', [
            'loyer' => $loyer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="loyer_show", methods={"GET"})
     */
    public function show(Loyer $loyer): Response
    {
        return $this->render('loyer/show.html.twig', [
            'loyer' => $loyer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="loyer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Loyer $loyer): Response
    {
        $form = $this->createForm(LoyerType::class, $loyer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('loyer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('loyer/edit.html.twig', [
            'loyer' => $loyer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="loyer_delete", methods={"POST"})
     */
    public function delete(Request $request, Loyer $loyer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$loyer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($loyer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('loyer_index', [], Response::HTTP_SEE_OTHER);
    }
}
