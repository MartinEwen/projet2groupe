<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\Comment;
use App\Entity\Picture;
use App\Form\TicketType;
use App\Form\CommentType;
use App\Service\PictureService;
use App\Repository\TicketRepository;
use App\Repository\CommentRepository;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/ticket')]
class TicketController extends AbstractController
{
    
    #[Route('/', name: 'app_ticket_index', methods: ['GET'])]
    public function index(TicketRepository $ticketRepository, PictureRepository $pictureRepository): Response
    {
        return $this->render('ticket/index.html.twig', [
            'tickets' => $ticketRepository->findAllDesc(),
            'pictures' => $pictureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ticket_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request, 
        EntityManagerInterface $entityManager, 
        SluggerInterface $slugger, 
        PictureService $pictureService
        ): Response
    {
        $ticket = new Ticket();
        $user = $this->getUser();
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('pictures')->getData();
            foreach($images as $image){
                $folder = 'pictures';
                $fichier = $pictureService->add($image, $folder);
                $img = new Picture();
                $img->setName($fichier);
                $ticket->addPicture($img);
            }
            $slug = $slugger->slug($ticket->getTitle());
            $ticket->setSlug($slug);

            $ticket->setUsers($user);
            $entityManager->persist($ticket);
            $entityManager->flush();

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ticket/new.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ticket_show', methods: ['GET'])]
    public function show(Ticket $ticket, CommentRepository $commentRepository): Response
    {
        return $this->render('ticket/show.html.twig', [
            'ticket' => $ticket,
            'comments' => $commentRepository->findBy([]),
        ]);
    }

    #[Route('/show/{id}', name: 'app_show', methods: ['GET', 'POST'])]
    public function showMain(
        Ticket $ticket, 
        Request $request,
        CommentRepository $commentRepository, 
        PictureRepository $pictureRepository,
        EntityManagerInterface $entityManager,
        TicketRepository $ticketRepository, $id, 
        PictureService $pictureService
        ): Response
    {
        $comment = new Comment();
        $user = $this->getUser();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        $id = $ticketRepository->find($id);
        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('pictures')->getData();
            foreach($images as $image){
                $folder = 'pictures';
                $fichier = $pictureService->add($image, $folder);
                $img = new Picture();
                $img->setName($fichier);
                $comment->addPicture($img);
            }
            $comment->setUsers($user);
            $comment->setTicket($id);
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ticket/show-main.html.twig', [
            'tickets' => $ticket,
            'ticket' => $ticketRepository->findAllDesc(),
            'pictures' => $pictureRepository,
            'comments' => $commentRepository->findBy([]),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ticket_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request, 
        TicketRepository $ticketRepository, 
        Ticket $ticket, 
        EntityManagerInterface $entityManager, 
        $id
        ): Response
    {
        $form = $this->createForm(TicketType::class, $ticket);
        $ticket = $ticketRepository->find($id);
        $comment->getTicket($ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = $ticketRepository->find($id);
            $entityManager->flush();

            return $this->redirectToRoute('app_ticket_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ticket/edit.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ticket_delete', methods: ['POST'])]
    public function delete(Request $request, Ticket $ticket, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ticket->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ticket);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ticket_index', [], Response::HTTP_SEE_OTHER);
    }
}
