<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Entity\User;
use App\Form\MessageType;
use App\Repository\MessagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends AbstractController
{
    /**
     * @Route("/messages", name="app_messages")
     */
    public function index(): Response
    {
        return $this->render('messages/index.html.twig', [
            'controller_name' => 'MessagesController',
        ]);
    }
    /**
     * @Route("/messages/{id}", name="app_messages")
     */
    public function discussion(int $id,MessagesRepository $messagesRepository,Request $request): Response
    {
        $NewMessage=New Messages();
        $user1 = $this->getDoctrine()->getRepository(User::class)->find(1);
        $user2 = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->createForm(MessageType::class,$NewMessage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime('@'.strtotime('now'));
            $NewMessage->setDate($date);
            $NewMessage->setSenderId($user1);
            $NewMessage->setRecipientId($user2);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($NewMessage);
            $entityManager->flush();
        }
        return $this->render('messages/index.html.twig', [
            'controller_name' => 'MessagesController',
            "messages" => $messagesRepository->findBySenderAndRecipient($user1,$user2),
            "ConnectedUser"=>$user1,
            "OtherUser"=>$user2,
            "userId" =>1,
            'form' => $form->createView()
        ]);
    }
}
