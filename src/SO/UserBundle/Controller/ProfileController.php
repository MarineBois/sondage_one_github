<?php

namespace SO\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SO\PlatformBundle\Sondages;
use SO\UserBundle\User;
use SO\PlatformBundle\Entity\Sondage;
use SO\PlatformBundle\Form\SondageType;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ProfileController extends Controller
{

    public function showAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        //formulaire d'ajout du sondage :
        $sondage = new Sondage();
        $sondage->setUser($user);
        $form = $this->get('form.factory')->create(SondageType::class, $sondage);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sondage);
            $em->flush();
      
            $request->getSession()->getFlashBag()->add('notice', 'Votre sondage a bien été créé.');
        }

        // liste de tous les sondages de l'utilisateur:
        $listeSondage = $em
        ->getRepository('SOPlatformBundle:Sondage')
        ->findAllByUser($user->getId());

        //var_dump($listeSondage);

        return $this->render('@SOUser/profile/show_content.html.twig', array(
            'form' => $form->createView(),
            'listeSondage' => $listeSondage,
            'user' => $user,
        ));    
        
    }

    


}