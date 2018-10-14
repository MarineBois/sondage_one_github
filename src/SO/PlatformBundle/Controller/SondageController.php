<?php

namespace SO\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SO\PlatformBundle\Entity\Commentaire;
use SO\PlatformBundle\Entity\Reponse;
use SO\PlatformBundle\Entity\Sondage;

use FOS\UserBundle\Form\Factory\FactoryInterface;
use SO\PlatformBundle\Form\CommentaireType;


class SondageController extends Controller
{

    public function affichageAction (Sondage $sondage,  Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //formulaire d'ajout d'un commentaire :
        $commentaire = new Commentaire();
        $commentaire->setSondage($sondage);
        $form = $this->get('form.factory')->create(CommentaireType::class, $commentaire);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();
            
            $request->getSession()->getFlashBag()->add('notice', 'Votre commentaire a bien été ajouté.');
        }
        
        $propositions = $sondage->getPropositions();
        $commentaires = $sondage->getCommentaires();

        //ajout d'une réponse :
        if (!empty($_POST['personne'])) 
        {
            foreach ($_POST as $value)
            {
                if (is_numeric($value)){
                    $proposition = $em->getRepository('SOPlatformBundle:Proposition')->findById($value);
                    $proposition = $proposition[0];
                    $reponse = new Reponse();
                    $reponse->setProposition($proposition)->setReponse("oui")->setPersonne($_POST['personne']);
                    $em->persist($reponse);
                    $em->flush();
                }
            }
        }

        $propositionsId = array ();
        foreach ($propositions as $value) {
            $id = $value->getId();
            array_push($propositionsId,$id);
        }

        $reponses = $em->getRepository('SOPlatformBundle:Reponse')->findAllByProposition($propositionsId);

        $i = 0;
        $reponsesPersonnes = array();
        foreach ($reponses as $personne) {
            $nomPersonne = $personne->getPersonne();
            $reponsesPersonnes[$nomPersonne][$i] = $personne;
            $i++;

        }

        return $this->render('@SOPlatform/Sondage/affichageSondage.html.twig', array(
            'action' => $_SERVER['PHP_SELF'],
            'sondage' => $sondage,
            'form' => $form->createView(),
            'commentaires' => $commentaires,
            'propositions' => $propositions,
            'reponses' => $reponses,
            'reponsesPersonne' => $reponsesPersonnes,
        ));
        
    }

    public function supprimerAction(Sondage $sondage) {
        $em = $this->getDoctrine()->getManager();
        //requete de suppression :
        $em->remove($sondage);
        $em->flush($sondage);

        $message = "Le sondage a bien été supprimée";

        return $this->redirectToRoute('so_user_profile');
    }

}