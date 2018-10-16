<?php

namespace SO\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SO\PlatformBundle\Entity\Proposition;
use SO\PlatformBundle\Entity\Sondage;
use SO\PlatformBundle\Entity\Reponse;



class ReponseController extends Controller
{
    public function ajouterAction (Request $request, Sondage $sondage)
    {
        $personne = $_POST['personne'];
        $propositions = $_POST['proposition'];
        foreach ($propositions as $propositionId) {

            $em = $this->getDoctrine()->getManager();

            //creation du nouvel objet reponse
            $reponse = new Reponse();
            $reponse->setPersonne($personne);

            //récupération de l'objet proposition associé
            $proposition = $em->getRepository('SOPlatformBundle:Proposition')->findById($propositionId);

            $reponse->setProposition($proposition['0']);
            $reponse->setReponse('oui');

            $em->persist($reponse);
            $em->flush();
        }

        $sondageId = $sondage->getId();

        return $this->redirectToRoute('so_platform_sondage', array('id' => $sondageId));
        
    }

}