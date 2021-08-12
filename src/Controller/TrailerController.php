<?php

namespace App\Controller;

use App\Entity\Trailer;
use App\Form\TrailerType;
use App\Repository\TrailerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trailer")
 */
class TrailerController extends AbstractController
{
    /**
     * @Route("/", name="trailer_index", methods={"GET"})
     */
    public function index(TrailerRepository $trailerRepository): Response
    {
        return $this->render('trailer/index.html.twig', [
            'trailers' => $trailerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="trailer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $trailer = new Trailer();
        $form = $this->createForm(TrailerType::class, $trailer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trailer);
            $entityManager->flush();

            return $this->redirectToRoute('trailer_index');
        }

        return $this->render('trailer/new.html.twig', [
            'trailer' => $trailer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="trailer_show", methods={"GET"})
     */
    public function show(Trailer $trailer): Response
    {
        return $this->render('trailer/show.html.twig', [
            'trailer' => $trailer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="trailer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Trailer $trailer): Response
    {
        $form = $this->createForm(TrailerType::class, $trailer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('trailer_index');
        }

        return $this->render('trailer/edit.html.twig', [
            'trailer' => $trailer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="trailer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Trailer $trailer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trailer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($trailer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('trailer_index');
    }
}
