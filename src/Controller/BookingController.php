<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Invoice;
use App\Entity\Market;
use App\Entity\Status;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/booking")
 * methods={"GET","POST"}
 */
class BookingController extends AbstractController
{
    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/", name="booking_test", methods={"GET","POST"})
     */
    public function index(): Response
    {

        $status = Request::createFromGlobals();
        $statusId = $status->request->get('elselect');
        if ($statusId == 0) {

            $bookings = $this->getDoctrine()->getRepository(Market::class)
                ->findBy(['author' => $this->getUser()]);
        } else {
            $bookings = $this->getDoctrine()->getRepository(Market::class)
                ->findBy(['author' => $this->getUser(), 'status' => $statusId]);
        }
        return $this->render('booking/index.html.twig',
            [
                'bookings' => $bookings,

            ]
        );

    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/new", name="booking_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $booking->setAuthor($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($booking);
            $entityManager->flush();

            return $this->redirectToRoute('market_index');
        }

        return $this->render('booking/new.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/{id}", name="booking_show", methods={"GET"})
     * @param Booking $booking
     * @return Response
     */
    public function show(Booking $booking): Response
    {
        return $this->render('booking/edit.html.twig', [
            'booking' => $booking,
        ]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/{id}/edit", name="booking_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Booking $booking
     * @return Response
     */
    public function edit(Request $request, Booking $booking): Response
    {


        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('booking_dash');
        }

        return $this->render('booking/edit.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/{id}", name="booking_delete", methods={"DELETE"})
     * @param Request $request
     * @param Booking $booking
     * @return Response
     */
    public function delete(Request $request, Booking $booking): Response
    {
        if ($this->isCsrfTokenValid('delete' . $booking->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($booking);
            $entityManager->persist($booking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('booking_test');
    }

    /**
     * @Route("dash", name="booking_dash",  methods={"GET","POST"})
     * @param BookingRepository $bookingRepository
     * @return Response
     */
    public function mainDash(BookingRepository $bookingRepository): Response
    {
        $product = $this->getDoctrine()
            ->getRepository(Market::class)
            ->findAll();
        return $this->render('booking/index.html.twig', [
            'bookings' => $bookingRepository->findBy(['author' => $this->getUser()->getCompany(),
                'market' => $product])
        ]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/{id}/update", name="booking_update", methods={"GET","POST"})
     * @param Request $request
     * @param Booking $booking
     * @return Response
     */
    public function updateBook(Request $request, Booking $booking): Response
    {
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $status = $this->getDoctrine()->getRepository(Status::class)->find(4);
            if ($booking->getStatus() == $status) {
                $invoice = new Invoice();
                $invoice->setIdentifier(00001);
                $invoice->setBookingId($booking);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($invoice);
                $entityManager->flush();
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('booking_dash');
        }
        return $this->render('booking/test.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);

    }
}
