<?php

namespace App\Controller;



use App\Entity\Market;
use App\Entity\Proposal;
use App\Entity\Status;
use App\Form\MarketType;
use App\Repository\MarketRepository;
use App\Repository\ProposalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/market")
 */
class MarketController extends AbstractController
{

    /**
     * @Route("/", name="market_index", methods={"GET"})
     * @param MarketRepository $marketRepository
     * @return Response
     */
    public function index(MarketRepository $marketRepository): Response
    {
        return $this->render('market/index.html.twig', [
            'markets' => $marketRepository->findAll(),


        ]);
    }

    /**
     * @Route("/new", name="market_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $status =$this->getDoctrine()->getRepository(Status::class)->find(1);
        $market = new Market();
        $form = $this->createForm(MarketType::class, $market);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $market->setStatus($status);
            $market->setAuthor($this->getUser()->getCompany());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($market);
            $entityManager->flush();



            return $this->redirectToRoute('market_index');
        }

        return $this->render('market/new.html.twig', [
            'market' => $market,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="market_show", methods={"GET"})
     * @param Market $market
     * @return Response
     */
    public function show(Market $market): Response
    {

        return $this->render('market/show.html.twig', [
            'market' => $market,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="market_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Market $market
     * @return Response
     */
    public function edit(Request $request, Market $market): Response
    {
        $form = $this->createForm(MarketType::class, $market);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('market_index');
        }

        return $this->render('market/edit.html.twig', [
            'market' => $market,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="market_delete", methods={"DELETE"})
     * @param Request $request
     * @param Market $market
     * @return Response
     */
    public function delete(Request $request, Market $market): Response
    {
        if ($this->isCsrfTokenValid('delete' . $market->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($market);
            $entityManager->flush();
        }

        return $this->redirectToRoute('market_index');
    }

    /**
     * @Route("dash", name="market_dash",  methods={"GET","POST"})
     * @param MarketRepository $marketRepository
     * @return Response
     */
    public function mainDash(MarketRepository $marketRepository): Response
    {

        return $this->render('market/dash.html.twig', [
            'markets' => $marketRepository->findAll()
        ]);
    }
}
