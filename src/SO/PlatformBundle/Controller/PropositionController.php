<?php

namespace SO\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SO\PlatformBundle\Entity\Proposition;
use SO\PlatformBundle\Entity\Sondage;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use SO\PlatformBundle\Form\PropositionType;


class PropositionController extends Controller
{
    public function showAction (Sondage $sondage, Request $request, $message = "") {
        $em = $this->getDoctrine()->getManager();
        $id = $sondage->getId();
        //formulaire d'ajout d'une proposition :
            $proposition = new Proposition();
            $proposition->setSondage($sondage);
            $form = $this->get('form.factory')->create(PropositionType::class, $proposition);
    
            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
                $this->ajouterAction($em, $proposition,$request);
            }

        //afficher les propositions :
        $propositions = $em
        ->getRepository('SOPlatformBundle:Proposition')
        ->findAllBySondage($id);

        return $this->render('@SOPlatform/Proposition/proposition.html.twig', array(
            'message' =>$message,
            'sondage' => $sondage,
            'form' => $form->createView(),
            'propositions' => $propositions,
        ));
    }

    public function ajouterAction ($em, $proposition, $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($proposition);
        $em->flush();
    
        $request->getSession()->getFlashBag()->add('notice', 'Votre proposition a bien été ajouté.');
        
    }

    public function supprimerAction (Proposition $proposition, Sondage $sondage,  Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($proposition);
        $em->flush($proposition);

        $message = "La proposition a bien été supprimée";

        return $this->showAction($sondage, $request, $message);
    }
}