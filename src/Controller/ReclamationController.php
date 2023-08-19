<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\User;
use App\Form\ReclamationType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReclamationController extends AbstractController
{
    /**
     * @Route("/reclamation", name="app_reclamation")
     */
    public function ajout(Request $request): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class,$reclamation);
        $form->handleRequest($request);
        $em=$this->getDoctrine()->getManager();
        $userr = $em->getRepository(User::class)->findOneBy(["id"=>1]);
        $reclamation->setUser($userr);
        $reclamation->setEtat(0);
        $date = new \DateTime('@'.strtotime('now'));
        $reclamation->setDateEnvoi($date);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();
        }
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
            'form' =>   $form->createView()
        ]);
    }

}
