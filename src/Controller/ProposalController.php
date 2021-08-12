<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Proposal;
use App\Entity\Status;
use App\Form\ProposalType;
use App\Repository\MarketRepository;
use App\Repository\ProposalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/proposal")
 */
class ProposalController extends AbstractController
{
    /**
     * @Route("/", name="proposal_index", methods={"GET"})
     */
    public function index(ProposalRepository $proposalRepository, Request $request): Response
    {
        return $this->render('proposal/index.html.twig', [
            'proposals' => $proposalRepository->findBy(['market' => $request->query->get('id')])
        ]);
    }

    /**
     * @Route("/new", name="proposal_new", methods={"GET","POST"})
     * @param Request $request
     * @param MarketRepository $marketRepository
     * @return Response
     */
    public function new(Request $request, MarketRepository $marketRepository): Response
    {
        $market = $marketRepository->find(['id' => $request->query->get('id')]);
        $booking = new Booking();
        $proposal = new Proposal();
        $status = $this->getDoctrine()->getRepository(Status::class)->find(1);
        $user = $this->getDoctrine()
            ->getRepository('App:Proposal')
            ->findOneBy(array('author' => $this->getUser()->getCompany(), 'market' => $market));
        $form = $this->createForm(ProposalType::class, $proposal);
        if (!$user) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $proposal->setAuthor($this->getUser()->getCompany());
                $proposal->setMarket($market);
                $proposal->setIsAccepted(false);
                $booking->setAuthor($this->getUser()->getCompany());
                $booking->setMarket($market);
                $booking->setProposals($proposal);
                $booking->setStatus($status);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($proposal);
                $entityManager->persist($booking);
                $entityManager->flush();
                return $this->redirectToRoute('booking_dash');
            }
        } else {
            throw $this->createNotFoundException(
                'Вече сте направили предложение'
            );
        }
        return $this->render('proposal/new.html.twig', [
            'proposal' => $proposal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="proposal_show", methods={"GET"})
     */
    public function show(Proposal $proposal): Response
    {
        return $this->render('proposal/show.html.twig', [
            'proposal' => $proposal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="proposal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Proposal $proposal): Response
    {
        $form = $this->createForm(ProposalType::class, $proposal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proposal_index');
        }

        return $this->render('proposal/edit.html.twig', [
            'proposal' => $proposal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="proposal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Proposal $proposal): Response
    {
        if ($this->isCsrfTokenValid('delete' . $proposal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($proposal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('proposal_index');
    }

    /**
     * @Route("/{id}/accept", name="proposal_accept", methods={"POST"})
     */
    public function isAccepted(Proposal $proposal): Response
    {

        $market = $proposal->getMarket();
        $entityManager = $this->getDoctrine()->getManager();
        $booking = $entityManager->getRepository(Booking::class)->findOneBy(['market' => $market]);
        $allBooking = $entityManager->getRepository(Booking::class)->findBy(['market' => $market]);
        $proposal = $entityManager->getRepository(Proposal::class)->find($proposal->getId());
        if (!$proposal) {
            throw $this->createNotFoundException(
                'No booking found for id ' . $proposal->getId()
            );
        }
        $status = $this->getDoctrine()->getRepository(Status::class)->find(2);
        $rejectStatus = $this->getDoctrine()->getRepository(Status::class)->find(6);
        $market->setStatus($status);
        $booking->setStatus($status);
        foreach ($allBooking as $books) {
            if ($books->getStatus() != $status) {
                $books->setStatus($rejectStatus);
            }
        }
        $proposal->setIsAccepted(true);
        $entityManager->flush();
        return $this->redirectToRoute('market_index', [
            'id' => $proposal
        ]);
    }
}
